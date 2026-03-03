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
$tbUsers = TB_USERS;

$message = '';
$messageType = '';

$userData = $fcObj->userCheck($tbUsers, $_SESSION['userName']);
if (empty($userData)) {
    header('Location: ' . BASE_URL . '/public/pages/Authentication/logout.php');
    exit;
}

$user = $userData[0];
$currentProfileImage = trim((string)$user['image']);
$currentProfileImageUrl = $currentProfileImage !== '' ? BASE_URL . '/public/assets/images/users/' . rawurlencode($currentProfileImage) : '';

if (isset($_POST['update_profile'])) {
    $username = trim($_POST['username']);
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);
    $address = trim($_POST['address']);
    $mobile = trim($_POST['mobile_no']);
    $newPassword = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if ($username === '' || $firstName === '' || $lastName === '' || $email === '') {
        $message = 'Username, first name, last name, and email are required.';
        $messageType = 'danger';
    } elseif ($username !== $user['username'] && !empty($fcObj->userCheck($tbUsers, $username))) {
        $message = 'That username is already taken.';
        $messageType = 'danger';
    } elseif ($newPassword !== '' && $newPassword !== $confirmPassword) {
        $message = 'New password and confirm password do not match.';
        $messageType = 'danger';
    } else {
        $passwordToStore = $user['password'];
        $imageToStore = trim((string)$user['image']);
        $uploadedImagePath = '';
        $isNewImageUploaded = false;

        if ($newPassword !== '') {
            $passwordToStore = sha1($newPassword);
        }

        if (isset($_FILES['profile_image']) && is_uploaded_file($_FILES['profile_image']['tmp_name'])) {
            $originalName = (string)$_FILES['profile_image']['name'];
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'webp');
            $maxSize = 2 * 1024 * 1024;

            if (!in_array($extension, $allowedExtensions, true)) {
                $message = 'Profile photo must be JPG, JPEG, PNG, or WEBP.';
                $messageType = 'danger';
            } elseif ((int)$_FILES['profile_image']['size'] > $maxSize) {
                $message = 'Profile photo must be 2MB or smaller.';
                $messageType = 'danger';
            } else {
                $uploadDir = ROOT_PATH . '/public/assets/images/users/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $safeAdmission = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$user['admission_id']);
                $imageToStore = 'user_' . $safeAdmission . '_' . date('YmdHis') . '.' . $extension;
                $uploadedImagePath = $uploadDir . $imageToStore;

                if (!@move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadedImagePath)) {
                    $message = 'Failed to upload profile photo. Please try again.';
                    $messageType = 'danger';
                } else {
                    $isNewImageUploaded = true;
                }
            }
        }

        if ($message !== '') {
            // Validation/upload failure already set the message.
        } else {
        $varArray = array(
            'username' => $username,
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
            'image' => $imageToStore
        );

        $updated = $fcObj->changeUserProfile($tbUsers, $varArray, $_SESSION['userName']);

        if ($updated) {
            $_SESSION['userName'] = $username;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['image'] = $imageToStore;
            $message = 'Your profile has been updated successfully.';
            $messageType = 'success';
            $userData = $fcObj->userCheck($tbUsers, $_SESSION['userName']);
            $user = $userData[0];
            $currentProfileImage = trim((string)$user['image']);
            $currentProfileImageUrl = $currentProfileImage !== '' ? BASE_URL . '/public/assets/images/users/' . rawurlencode($currentProfileImage) : '';
        } else {
            if ($isNewImageUploaded && $uploadedImagePath !== '' && file_exists($uploadedImagePath)) {
                @unlink($uploadedImagePath);
            }
            $message = 'Profile update failed. Please try again.';
            $messageType = 'danger';
        }
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

<div class="container user-profile-wrap user-layout-wrap">
    <div class="user-dashboard-shell row g-4">
        <div class="col-lg-3">
            <aside class="user-side-panel">
                <div class="user-side-brand">Department Portal</div>

                <nav class="user-side-nav user-side-nav-main">
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php"><i class="bi bi-speedometer2 user-side-link-icon"></i><span>Dashboard</span></a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/academics.php"><i class="bi bi-mortarboard user-side-link-icon"></i><span>Academics</span></a>
                    <a class="user-side-link" href="https://erp.nrcmec.org/"><i class="bi bi-journal-check user-side-link-icon"></i><span>Exam Cell</span></a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/achievements.php"><i class="bi bi-trophy user-side-link-icon"></i><span>Upload Achievement</span></a>
                    <a class="user-side-link active" href="<?php echo BASE_URL; ?>/public/pages/user/profile.php"><i class="bi bi-person-gear user-side-link-icon"></i><span>Account Settings</span></a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/downloads.php"><i class="bi bi-download user-side-link-icon"></i><span>Downloads</span></a>
                </nav>

                <nav class="user-side-nav user-side-nav-utility">
                    <a class="user-side-link user-side-link-logout" href="<?php echo BASE_URL; ?>/public/pages/Authentication/logout.php"><i class="bi bi-box-arrow-right user-side-link-icon"></i><span>Logout</span></a>
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

                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="border rounded p-3 bg-light">
                                <label class="form-label fw-semibold mb-2">Update Profile Photo</label>
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <?php if ($currentProfileImageUrl !== '') { ?>
                                            <img src="<?php echo htmlspecialchars($currentProfileImageUrl); ?>" alt="Current profile photo" style="width:90px;height:90px;object-fit:cover;border-radius:10px;border:1px solid #cfd7de;">
                                        <?php } else { ?>
                                            <div style="width:90px;height:90px;border-radius:10px;border:1px solid #cfd7de;display:flex;align-items:center;justify-content:center;background:#eef2f4;color:#5a6876;font-size:12px;">No Photo</div>
                                        <?php } ?>
                                    </div>
                                    <div class="col">
                                        <input type="file" name="profile_image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                        <div class="form-text">Allowed: JPG, JPEG, PNG, WEBP (max 2MB). Click "Update Profile" to save.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
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
                        <button type="submit" name="update_profile" class="btn btn-warning">Update Profile & Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

