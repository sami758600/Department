<?php
if (session_id() == '') {
    session_start();
}

require_once(__DIR__ . '/../../../config.php');
require_once(LIB_PATH . '/functions.class.php');
require_once(LIB_PATH . '/security.php');

$fcObj = new DataFunctions();

$tbBatch  = TB_BATCH;
$tbStream = TB_STREAM;
$tbClass  = TB_CLASS;
$tbSection = TB_SECTION;

$batches = $fcObj->getBatches($tbBatch);

/* --------- REDIRECT IF LOGGED IN --------- */
if (isset($_SESSION['userName'])) {
    header('Location: ' . BASE_URL . '/');
    exit;
}

/* --------- FORM SUBMIT --------- */
if (isset($_POST['submit'])) {
    if (!app_validate_csrf_token($_POST['csrf_token'] ?? '')) {
        $_SESSION['err_msg'] = 'Your session expired. Please try again.';
        header('Location: ' . BASE_URL . '/public/pages/Authentication/register.php');
        exit;
    }

    $uName       = trim((string)$_POST['uname']);
    $pass        = (string)$_POST['pword'];
    $cPass       = (string)$_POST['confirmpassword'];
    $fName       = trim((string)$_POST['firstname']);
    $lName       = trim((string)$_POST['lastname']);
    $gender      = trim((string)$_POST['gender']);
    $email       = trim((string)$_POST['email']);
    $address     = trim((string)$_POST['address']);
    $phone       = trim((string)$_POST['phone']);
    $batchId     = (int)$_POST['batchId'];
    $year        = (int)($_POST['year'] ?? 0);
    $sectionName = trim((string)($_POST['sectionName'] ?? ''));
    $admissionId = trim((string)$_POST['admissionId']);

    $streamId = $year > 0 ? $fcObj->getOrCreateStreamIdByCode($tbStream, (string)$year, 'Year ' . $year) : 0;
    $class = $fcObj->getDefaultClassIdForYear($tbClass, $year);
    $sectionId = ($class > 0 && $sectionName !== '') ? $fcObj->getOrCreateSectionIdByName($tbSection, $class, $sectionName) : 0;

    if ($uName === '' || $pass === '' || $fName === '' || $lName === '' || $gender === '' || $email === '' || $address === '' || $phone === '' || $admissionId === '') {
        $_SESSION['err_msg'] = 'Please fill all required fields.';
    } elseif ($pass !== $cPass) {
        $_SESSION['err_msg'] = 'Passwords do not match';
    } elseif (strlen($pass) < 8) {
        $_SESSION['err_msg'] = 'Password must be at least 8 characters long.';
    } elseif ($class <= 0 || $batchId <= 0 || $streamId <= 0 || $sectionId <= 0) {
        $_SESSION['err_msg'] = 'Please select valid Batch, Year, Class and Section.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['err_msg'] = 'Please enter a valid email address.';
    } else {

        $fileName = '';
        if (!empty($_FILES['usrImage']['name']) && isset($_FILES['usrImage']['tmp_name'])) {
            $safeAdmissionId = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$admissionId);
            $uploadDir = ROOT_PATH . '/public/assets/images/users/';
            $uploadError = '';
            $fileName = app_store_uploaded_image($_FILES['usrImage'], $uploadDir, 'user_' . $safeAdmissionId, $uploadError, 2 * 1024 * 1024);
            if ($fileName === '') {
                $_SESSION['err_msg'] = $uploadError;
            }
        }

        if (!isset($_SESSION['err_msg'])) {
            $varArray = [
                'username'      => $uName,
                'password'      => $fcObj->hashPassword($pass),
                'mail_id'       => $email,
                'firstname'     => $fName,
                'lastname'      => $lName,
                'gender'        => $gender,
                'address'       => $address,
                'mobile_no'     => $phone,
                'batch_id'      => $batchId,
                'stream_id'     => $streamId,
                'section'       => $sectionId,
                'admission_id'  => $admissionId,
                'image'         => $fileName,
                'status'        => 0
            ];

            $tbUser = TB_USERS;
            $register = $fcObj->regUser($tbUser, $varArray);

            if ($register == 1) {
                $_SESSION['success_msg'] = 'Registration successful. Please login.';
                app_rotate_csrf_token();
                header('Location: ' . BASE_URL . '/public/pages/Authentication/login.php');
                exit;
            } else {
                if ($fileName !== '') {
                    $uploadedFilePath = ROOT_PATH . '/public/assets/images/users/' . $fileName;
                    if (is_file($uploadedFilePath)) {
                        @unlink($uploadedFilePath);
                    }
                }
                $_SESSION['err_msg'] = is_string($register) ? $register : 'Registration failed. Please verify your details and try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | AIML Department</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/register.css">

    
</head>

<body>

<div class="auth-shell">
    <div class="auth-frame auth-frame-wide">
        <header class="auth-header">
            <div class="brand-mark">AIML Department</div>
            <div class="auth-switch" role="tablist" aria-label="Authentication pages">
                <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/register.php" class="switch-link active" aria-current="page">Sign up</a>
                <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/login.php" class="switch-link">Login</a>
            </div>
        </header>

        <main class="auth-panel">
            <div class="auth-copy">
                <h2 class="auth-title">Create your department account</h2>
                <p class="auth-subtitle">Fill in your details to complete student registration.</p>
            </div>

            <?php if (isset($_SESSION['err_msg'])) { ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['err_msg']; unset($_SESSION['err_msg']); ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data" class="register-form">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(app_get_csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">
                <div class="form-section">
                    <h6>Account</h6>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <input type="text" name="uname" class="form-control modern-input" placeholder="Username" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="admissionId" class="form-control modern-input" placeholder="Admission ID" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="pword" class="form-control modern-input" placeholder="Password" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="confirmpassword" class="form-control modern-input" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h6>Personal</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="firstname" class="form-control modern-input" placeholder="First Name" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="lastname" class="form-control modern-input" placeholder="Last Name" required>
                        </div>
                        <div class="col-md-4">
                            <select name="gender" class="form-select modern-input" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control modern-input" placeholder="Email Address" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="phone" class="form-control modern-input" placeholder="Phone Number" required>
                        </div>
                        <div class="col-12">
                            <input type="text" name="address" class="form-control modern-input" placeholder="Home Address" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h6>Academic</h6>
                    <div class="row g-3">
                        <div class="col-sm-6 col-lg-4">
                            <select name="batchId" class="form-select modern-input" required>
                                <option value="">Academic Batch</option>
                                <?php foreach ($batches as $b) { ?>
                                    <option value="<?= $b['id']; ?>"><?= $b['batch']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <select name="year" class="form-select modern-input" required>
                                <option value="">Year</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-lg-4" id="sectionWrap">
                            <input type="text" name="sectionName" id="sectionName" class="form-control modern-input" placeholder="Section (e.g., A)" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h6>Profile Photo</h6>
                    <input type="file" name="usrImage" class="form-control modern-input file-input">
                </div>

                <button type="submit" name="submit" class="btn create-btn w-100">
                    Create My Account
                </button>
            </form>
        </main>
    </div>
</div>

<script>
document.querySelectorAll(".switch-link").forEach((link) => {
    link.addEventListener("click", (event) => {
        const target = link.getAttribute("href");
        if (!target || target === window.location.href) {
            return;
        }

        event.preventDefault();

        const navigate = () => {
            window.location.href = target;
        };

        if (document.startViewTransition) {
            document.startViewTransition(() => {
                navigate();
            });
            return;
        }

        document.body.classList.add("is-switching");
        window.setTimeout(navigate, 220);
    });
});
</script>

</body>




</html>
