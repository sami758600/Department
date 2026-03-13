<?php
if (session_id() == '') {
    session_start();
}

require_once(__DIR__ . '/../../../config.php');
require_once(LIB_PATH . '/functions.class.php');

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

$user = $userData[0];
$admissionId = trim((string)($user['admission_id'] ?? ''));
$achievements = $admissionId !== '' ? $fcObj->getAchievementsForAdmission(TB_ACHIEVEMENTS, $admissionId) : array();

function app_safe_achievement_file_url($fileName) {
    $fileName = trim((string)$fileName);
    if ($fileName === '' || preg_match('/^[A-Za-z0-9._-]+$/', $fileName) !== 1) {
        return '';
    }
    $diskPath = ROOT_PATH . '/public/assets/images/achievements/' . $fileName;
    if (!is_file($diskPath)) {
        return '';
    }
    return BASE_URL . '/public/assets/images/achievements/' . rawurlencode($fileName);
}

function app_format_achievement_meta($desc) {
    $desc = trim((string)$desc);
    $parts = explode(' - ', $desc, 3);
    if (count($parts) === 3) {
        return array('context' => $parts[1], 'text' => $parts[2]);
    }
    return array('context' => '', 'text' => $desc);
}

function app_guess_achievement_time($fileName) {
    $fileName = trim((string)$fileName);
    if (preg_match('/_([0-9]{14})_/', $fileName, $m) !== 1) {
        return '';
    }
    $raw = $m[1];
    $dt = DateTime::createFromFormat('YmdHis', $raw);
    if (!$dt) {
        return '';
    }
    return $dt->format('Y-m-d H:i');
}

include_once(INCLUDES_PATH . '/header.php');

$userActivePage = 'my_achievements';
include_once(__DIR__ . '/layout/main_header.php');
?>

<div class="user-summary-card user-profile-card user-achievement-card">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <h2 class="user-profile-title mb-0">My Achievements</h2>
        <a href="<?php echo BASE_URL; ?>/public/pages/user/achievements.php" class="btn user-back-btn">Upload New</a>
    </div>

    <?php if (empty($achievements)) { ?>
        <div class="text-muted">No achievements submitted yet.</div>
    <?php } else { ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="min-width: 130px;">Type</th>
                        <th>Details</th>
                        <th style="min-width: 120px;">File</th>
                        <th style="min-width: 140px;">Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($achievements as $row) { ?>
                        <?php
                            $rawDesc = (string)($row['achievement_desc'] ?? '');
                            $fileName = '';
                            $descText = $rawDesc;
                            if (strpos($rawDesc, '$$') !== false) {
                                $split = explode('$$', $rawDesc, 2);
                                $descText = $split[0];
                                $fileName = $split[1] ?? '';
                            }

                            $meta = app_format_achievement_meta($descText);
                            $fileUrl = app_safe_achievement_file_url($fileName);
                            $submittedAt = $fileName !== '' ? app_guess_achievement_time($fileName) : '';
                            $typeLabel = ((int)($row['category_id'] ?? 0) === DOCUMENT) ? 'Document' : 'Text';
                        ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($typeLabel, ENT_QUOTES, 'UTF-8'); ?></span></td>
                            <td>
                                <div class="fw-semibold"><?php echo htmlspecialchars($meta['text'], ENT_QUOTES, 'UTF-8'); ?></div>
                                <?php if ($meta['context'] !== '') { ?>
                                    <div class="text-muted small"><?php echo htmlspecialchars($meta['context'], ENT_QUOTES, 'UTF-8'); ?></div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($fileUrl !== '') { ?>
                                    <a class="btn btn-sm user-back-btn" href="<?php echo htmlspecialchars($fileUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">View</a>
                                <?php } else { ?>
                                    <span class="text-muted small">—</span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($submittedAt !== '') { ?>
                                    <span class="text-muted small"><?php echo htmlspecialchars($submittedAt, ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php } else { ?>
                                    <span class="text-muted small">—</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>

<?php include_once(__DIR__ . '/layout/main_footer.php'); ?>

