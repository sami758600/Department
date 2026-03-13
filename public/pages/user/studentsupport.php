<?php
if (session_id() == '') {
    session_start();
}

require_once(__DIR__ . '/../../../config.php');
require_once(LIB_PATH . '/functions.class.php');

if (!function_exists('supportReadSmtpResponse')) {
    function supportReadSmtpResponse($socket){
        $response = '';
        while (!feof($socket)) {
            $line = fgets($socket, 515);
            if ($line === false) {
                break;
            }
            $response .= $line;
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        return $response;
    }
}

if (!function_exists('supportSmtpCommand')) {
    function supportSmtpCommand($socket, $command, $expectedCodes){
        if ($command !== null) {
            fwrite($socket, $command . "\r\n");
        }

        $response = supportReadSmtpResponse($socket);
        $code = (int)substr((string)$response, 0, 3);
        if (!in_array($code, $expectedCodes, true)) {
            return false;
        }
        return true;
    }
}

if (!function_exists('supportSendViaSmtp')) {
    function supportSendViaSmtp($to, $subject, $body, $replyTo, $smtpSettings, &$errorMessage){
        $host = trim((string)($smtpSettings['smtp_host'] ?? ''));
        $port = (int)($smtpSettings['smtp_port'] ?? 587);
        $secure = strtolower(trim((string)($smtpSettings['smtp_secure'] ?? 'tls')));
        $username = trim((string)($smtpSettings['smtp_username'] ?? ''));
        $password = trim((string)($smtpSettings['smtp_password'] ?? ''));
        $fromEmail = trim((string)($smtpSettings['smtp_from_email'] ?? ''));
        $fromName = trim((string)($smtpSettings['smtp_from_name'] ?? ''));

        if ($host === '' || $username === '' || $password === '' || $fromEmail === '') {
            $errorMessage = 'SMTP settings are incomplete.';
            return false;
        }

        if ($port <= 0) {
            $port = ($secure === 'ssl') ? 465 : 587;
        }

        $transportHost = $host;
        if ($secure === 'ssl') {
            $transportHost = 'ssl://' . $host;
        }

        $socket = @fsockopen($transportHost, $port, $errno, $errstr, 20);
        if (!$socket) {
            $errorMessage = 'SMTP connect failed: ' . $errstr;
            return false;
        }

        stream_set_timeout($socket, 20);

        if (!supportSmtpCommand($socket, null, array(220))) {
            fclose($socket);
            $errorMessage = 'SMTP greeting failed.';
            return false;
        }

        if (!supportSmtpCommand($socket, 'EHLO localhost', array(250))) {
            fclose($socket);
            $errorMessage = 'SMTP EHLO failed.';
            return false;
        }

        if ($secure === 'tls') {
            if (!supportSmtpCommand($socket, 'STARTTLS', array(220))) {
                fclose($socket);
                $errorMessage = 'SMTP STARTTLS failed.';
                return false;
            }

            $cryptoEnabled = @stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            if (!$cryptoEnabled) {
                fclose($socket);
                $errorMessage = 'SMTP TLS negotiation failed.';
                return false;
            }

            if (!supportSmtpCommand($socket, 'EHLO localhost', array(250))) {
                fclose($socket);
                $errorMessage = 'SMTP EHLO after TLS failed.';
                return false;
            }
        }

        if (!supportSmtpCommand($socket, 'AUTH LOGIN', array(334)) ||
            !supportSmtpCommand($socket, base64_encode($username), array(334)) ||
            !supportSmtpCommand($socket, base64_encode($password), array(235))) {
            fclose($socket);
            $errorMessage = 'SMTP authentication failed.';
            return false;
        }

        if (!supportSmtpCommand($socket, 'MAIL FROM:<' . $fromEmail . '>', array(250)) ||
            !supportSmtpCommand($socket, 'RCPT TO:<' . $to . '>', array(250, 251)) ||
            !supportSmtpCommand($socket, 'DATA', array(354))) {
            fclose($socket);
            $errorMessage = 'SMTP envelope/data command failed.';
            return false;
        }

        $encodedSubject = function_exists('mb_encode_mimeheader')
            ? mb_encode_mimeheader($subject, 'UTF-8')
            : $subject;

        $headers = array();
        $headers[] = 'Date: ' . date('r');
        $headers[] = 'From: ' . ($fromName !== '' ? $fromName . ' ' : '') . '<' . $fromEmail . '>';
        if ($replyTo !== '') {
            $headers[] = 'Reply-To: ' . $replyTo;
        }
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';
        $headers[] = 'Subject: ' . $encodedSubject;
        $headers[] = 'To: <' . $to . '>';

        $safeBody = str_replace(array("\r\n", "\r"), "\n", $body);
        $safeBody = str_replace("\n.", "\n..", $safeBody);
        $data = implode("\r\n", $headers) . "\r\n\r\n" . str_replace("\n", "\r\n", $safeBody) . "\r\n.";

        if (!supportSmtpCommand($socket, $data, array(250))) {
            fclose($socket);
            $errorMessage = 'SMTP message body send failed.';
            return false;
        }

        supportSmtpCommand($socket, 'QUIT', array(221, 250));
        fclose($socket);
        return true;
    }
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user' || !isset($_SESSION['userName'])) {
    header('Location: ' . BASE_URL . '/public/pages/Authentication/login.php');
    exit;
}

$fcObj = new DataFunctions();
$userData = $fcObj->userCheck(TB_USERS, $_SESSION['userName']);
if (empty($userData)) {
    header('Location: ' . BASE_URL . '/public/pages/Authentication/logout.php');
    exit;
}

$supportMessage = '';
$supportMessageType = '';
$whatsAppRedirectUrl = '';
$mailToRedirectUrl = '';

$subject = '';
$messageBody = '';
$supportSettings = $fcObj->getSupportSettings(TB_SUPPORT_SETTINGS);
$supportEmail = trim((string)($supportSettings['support_email'] ?? ''));
$supportWhatsappNumber = trim((string)($supportSettings['whatsapp_number'] ?? ''));

if (isset($_POST['submit_support'])) {
    $subject = trim((string)($_POST['subject'] ?? ''));
    $messageBody = trim((string)($_POST['message'] ?? ''));

    if ($subject === '' || $messageBody === '') {
        $supportMessage = 'Subject and message are required.';
        $supportMessageType = 'danger';
    } else {
        $user = $userData[0];
        $studentName = trim(((string)($user['firstname'] ?? '')) . ' ' . ((string)($user['lastname'] ?? '')));
        if ($studentName === '') {
            $studentName = (string)($_SESSION['userName'] ?? 'Student');
        }
        $studentEmail = trim((string)($user['mail_id'] ?? ''));
        $studentUsername = (string)($_SESSION['userName'] ?? '');

        $emailSubject = '[Student Support] ' . $subject;
        $emailBody = "Student Support Request\n\n"
            . "Student Name: " . $studentName . "\n"
            . "Username: " . $studentUsername . "\n"
            . "Email: " . $studentEmail . "\n\n"
            . "Subject: " . $subject . "\n"
            . "Message:\n" . $messageBody . "\n";

        $emailConfigured = ($supportEmail !== '' && filter_var($supportEmail, FILTER_VALIDATE_EMAIL));
        $smtpSettings = array(
            'smtp_host' => trim((string)($supportSettings['smtp_host'] ?? '')),
            'smtp_port' => (int)($supportSettings['smtp_port'] ?? 587),
            'smtp_secure' => trim((string)($supportSettings['smtp_secure'] ?? 'tls')),
            'smtp_username' => trim((string)($supportSettings['smtp_username'] ?? '')),
            'smtp_password' => trim((string)($supportSettings['smtp_password'] ?? '')),
            'smtp_from_email' => trim((string)($supportSettings['smtp_from_email'] ?? '')),
            'smtp_from_name' => trim((string)($supportSettings['smtp_from_name'] ?? ''))
        );

        $smtpConfigured = ($smtpSettings['smtp_host'] !== '' && $smtpSettings['smtp_username'] !== '' && $smtpSettings['smtp_password'] !== '' && $smtpSettings['smtp_from_email'] !== '');
        $mailSent = false;
        $smtpError = '';
        if ($emailConfigured) {
            if ($smtpConfigured) {
                $mailSent = supportSendViaSmtp(
                    $supportEmail,
                    $emailSubject,
                    $emailBody,
                    $studentEmail,
                    $smtpSettings,
                    $smtpError
                );
            } else {
                $fromDomain = isset($_SERVER['HTTP_HOST']) ? preg_replace('/:\d+$/', '', (string)$_SERVER['HTTP_HOST']) : 'localhost';
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
                $headers .= "From: no-reply@" . $fromDomain . "\r\n";
                if ($studentEmail !== '') {
                    $headers .= "Reply-To: " . $studentEmail . "\r\n";
                }
                $mailSent = @mail($supportEmail, $emailSubject, $emailBody, $headers);
            }

            if (!$mailSent) {
                $mailToRedirectUrl = 'mailto:' . rawurlencode($supportEmail)
                    . '?subject=' . rawurlencode($emailSubject)
                    . '&body=' . rawurlencode($emailBody);
            }
        }

        $waNumber = preg_replace('/\D+/', '', $supportWhatsappNumber);
        $waConfigured = ($waNumber !== '');
        if ($waConfigured) {
            $waMessage = "Student Support Request\n"
                . "Student: " . $studentName . " (" . $studentUsername . ")\n"
                . "Subject: " . $subject . "\n"
                . "Message: " . $messageBody;
            $whatsAppRedirectUrl = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage);
        }

        if (!$emailConfigured && !$waConfigured) {
            $supportMessage = 'Support contact is not configured by admin yet.';
            $supportMessageType = 'danger';
        } elseif ($emailConfigured && !$mailSent && !$waConfigured) {
            $supportMessage = 'Email send failed on server. Your mail app will open with a prefilled draft.';
            $supportMessageType = 'warning';
            $subject = '';
            $messageBody = '';
        } elseif ($emailConfigured && !$mailSent && $waConfigured) {
            $supportMessage = 'Email send failed on server, but WhatsApp is ready. Mail app draft will also open.';
            $supportMessageType = 'warning';
            $subject = '';
            $messageBody = '';
        } elseif ($emailConfigured && $mailSent && $waConfigured) {
            $supportMessage = 'Your support request was sent by email and WhatsApp will open now.';
            $supportMessageType = 'success';
            $subject = '';
            $messageBody = '';
        } elseif ($emailConfigured && $mailSent) {
            $supportMessage = 'Your support request was sent successfully by email.';
            $supportMessageType = 'success';
            $subject = '';
            $messageBody = '';
        } else {
            $supportMessage = 'Your support request message is ready in WhatsApp.';
            $supportMessageType = 'success';
            $subject = '';
            $messageBody = '';
        }
    }
}

include_once(INCLUDES_PATH . '/header.php');

$userActivePage = 'studentsupport';
include_once(__DIR__ . '/layout/main_header.php');
?>

<div class="user-summary-card user-profile-card user-support-card">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="user-profile-title mb-1">Student Support</h2>
            <div class="user-support-subtitle">Raise your issue and our team will get back to you.</div>
        </div>
        <span class="user-support-badge"><i class="bi bi-headset"></i> Help Desk</span>
    </div>

    <?php if ($supportMessage !== '') { ?>
        <div class="alert alert-<?php echo $supportMessageType; ?> py-2 mb-3">
            <?php echo htmlspecialchars($supportMessage); ?>
        </div>
    <?php } ?>

    <?php if ($whatsAppRedirectUrl !== '') { ?>
        <div class="alert alert-info py-2 mb-3">
            If WhatsApp did not open automatically, <a href="<?php echo htmlspecialchars($whatsAppRedirectUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">click here</a>.
        </div>
    <?php } ?>

    <?php if ($mailToRedirectUrl !== '') { ?>
        <div class="alert alert-info py-2 mb-3">
            If your mail app did not open automatically, <a href="<?php echo htmlspecialchars($mailToRedirectUrl, ENT_QUOTES, 'UTF-8'); ?>">click here</a>.
        </div>
    <?php } ?>

    <form method="POST" action="" class="user-support-form">
    <div class="row g-3">
        <div class="col-md-8">
            <label class="form-label">Subject</label>
            <input
                type="text"
                name="subject"
                class="form-control"
                placeholder="Example: Unable to access previous papers"
                value="<?php echo htmlspecialchars($subject); ?>"
                required
            >
        </div>

        <div class="col-12">
            <label class="form-label">Message</label>
            <textarea
                name="message"
                rows="6"
                class="form-control"
                placeholder="Describe your issue clearly, include where and when it happened."
                required
            ><?php echo htmlspecialchars($messageBody); ?></textarea>
        </div>
    </div>

    <div class="mt-4 d-flex flex-wrap gap-2">
        <button type="submit" name="submit_support" class="btn user-support-submit">
            <i class="bi bi-send me-1"></i> Submit Request
        </button>
        <!-- <a href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php" class="btn btn-outline-secondary">
            Back to Dashboard
        </a> -->
    </div>
</form>
</div>

<?php if ($whatsAppRedirectUrl !== '') { ?>
<script>
window.addEventListener('load', function () {
    window.open('<?php echo htmlspecialchars($whatsAppRedirectUrl, ENT_QUOTES, 'UTF-8'); ?>', '_blank');
});
</script>
<?php } ?>

<?php if ($mailToRedirectUrl !== '') { ?>
<script>
window.addEventListener('load', function () {
    window.location.href = '<?php echo htmlspecialchars($mailToRedirectUrl, ENT_QUOTES, 'UTF-8'); ?>';
});
</script>
<?php } ?>

<?php include_once(__DIR__ . '/layout/main_footer.php'); ?>
