<?php
if (session_id() == '') {
    session_start();
}

require_once(__DIR__ . '/../../../config.php');
require_once(LIB_PATH . '/functions.class.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user' || !isset($_SESSION['userName'])) {
    header('Location: ' . BASE_URL . '/public/pages/authentication/login.php');
    exit;
}

$fcObj = new DataFunctions();
$tbUsers = TB_USERS;

$message = '';
$messageType = '';

$userData = $fcObj->userCheck($tbUsers, $_SESSION['userName']);
if (empty($userData)) {
    header('Location: ' . BASE_URL . '/public/pages/authentication/logout.php');
    exit;
}

$user = $userData[0];

if (isset($_POST['update_profile'])) {
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);
    $address = trim($_POST['address']);
    $mobile = trim($_POST['mobile_no']);
    $newPassword = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if ($firstName === '' || $lastName === '' || $email === '') {
        $message = 'First name, last name, and email are required.';
        $messageType = 'danger';
    } elseif ($newPassword !== '' && $newPassword !== $confirmPassword) {
        $message = 'New password and confirm password do not match.';
        $messageType = 'danger';
    } else {
        $passwordToStore = $user['password'];
        if ($newPassword !== '') {
            $passwordToStore = sha1($newPassword);
        }

        $varArray = array(
            'password' => $passwordToStore,
            'mail_id' => $email,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'gender' => $gender,
            'address' => $address,
            'mobile_no' => $mobile,
            'batch_id' => $user['batch_id'],
            'stream_id' => $user['stream_id'],
            'section' => $user['section'],
            'admission_id' => $user['admission_id'],
            'image' => $user['image']
        );

        $updated = $fcObj->changeUserProfile($tbUsers, $varArray, $_SESSION['userName']);

        if ($updated) {
            $_SESSION['firstName'] = $firstName;
            $message = 'Your profile has been updated successfully.';
            $messageType = 'success';
            $userData = $fcObj->userCheck($tbUsers, $_SESSION['userName']);
            $user = $userData[0];
        } else {
            $message = 'Profile update failed. Please try again.';
            $messageType = 'danger';
        }
    }
}

$streams = $fcObj->getStreams(TB_STREAM);
$userStreamName = 'N/A';
foreach ($streams as $stream) {
    if ((int)$stream['id'] === (int)$user['stream_id']) {
        $userStreamName = $stream['stream_name'] . ' (' . $stream['stream_code'] . ')';
        break;
    }
}

$classSection = $fcObj->getClsBySec(TB_SECTION, $user['section']);
$className = !empty($classSection) ? $classSection[0]['class_name'] : 'N/A';
$sectionName = !empty($classSection) ? $classSection[0]['section_name'] : 'N/A';

include_once(INCLUDES_PATH . '/header.php');
?>

<div class="container user-profile-wrap">
    <div class="user-dashboard-shell row g-4">
        <div class="col-lg-3">
            <aside class="user-side-panel">
                <div class="user-side-brand">Department Portal</div>

                <nav class="user-side-nav">
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php">Dashboard</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/academics.php">Academics</a>
                    <a class="user-side-link" href="https://erp.nrcmec.org/">Exam Cell</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php#syllabus-section">Library</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/achievements.php">Upload Achievement</a>
                    <a class="user-side-link active" href="<?php echo BASE_URL; ?>/public/pages/user/profile.php">Account Settings</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/downloads.php">Downloads</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/authentication/logout.php">Logout</a>
                </nav>
            </aside>
        </div>

        <div class="col-lg-9">
            <div class="user-summary-card user-profile-card">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <h2 class="user-profile-title mb-0">Edit My Details</h2>
                    <a href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                </div>

                <?php if ($message !== '') { ?>
                    <div class="alert alert-<?php echo $messageType; ?>"><?php echo htmlspecialchars($message); ?></div>
                <?php } ?>

                <form method="POST" action="">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Admission ID</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['admission_id']); ?>" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['mail_id']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mobile</label>
                            <input type="text" name="mobile_no" class="form-control" value="<?php echo htmlspecialchars($user['mobile_no']); ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label d-block">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="male" <?php echo ($user['gender'] === 'male') ? 'checked' : ''; ?>>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="female" <?php echo ($user['gender'] === 'female') ? 'checked' : ''; ?>>
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address']); ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Stream</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($userStreamName); ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Class</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($className); ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Section</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($sectionName); ?>" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Leave empty to keep current password">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Retype new password">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" name="update_profile" class="btn btn-warning">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>
