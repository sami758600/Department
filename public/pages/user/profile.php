<?php
if (session_id() == '') {
    session_start();
}

require_once(__DIR__ . '/../../../config.php');
require_once(LIB_PATH . '/functions.class.php');
require_once(LIB_PATH . '/security.php');

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
    if (!app_validate_csrf_token($_POST['csrf_token'] ?? '')) {
        $message = 'Your session expired. Please refresh and try again.';
        $messageType = 'danger';
    } else {
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
    } elseif ($newPassword !== '' && strlen($newPassword) < 8) {
        $message = 'New password must be at least 8 characters long.';
        $messageType = 'danger';
    } else {
        $passwordToStore = $user['password'];
        $imageToStore = trim((string)$user['image']);
        $uploadedImagePath = '';
        $isNewImageUploaded = false;

        if ($newPassword !== '') {
            $passwordToStore = $fcObj->hashPassword($newPassword);
        }

        if (isset($_FILES['profile_image']) && is_uploaded_file($_FILES['profile_image']['tmp_name'])) {
            $uploadDir = ROOT_PATH . '/public/assets/images/users/';
            $safeAdmission = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$user['admission_id']);
            $uploadError = '';
            $uploadedFile = app_store_uploaded_image($_FILES['profile_image'], $uploadDir, 'user_' . $safeAdmission, $uploadError, 2 * 1024 * 1024);

            if ($uploadedFile === '') {
                $message = $uploadError;
                $messageType = 'danger';
            } else {
                $imageToStore = $uploadedFile;
                $uploadedImagePath = $uploadDir . $imageToStore;
                $isNewImageUploaded = true;
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

$userActivePage = 'profile';
include_once(__DIR__ . '/layout/main_header.php');
?>
            <div class="user-summary-card user-profile-card">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <h2 class="user-profile-title mb-0">Edit My Details</h2>
                    <a href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                </div>

                <?php if ($message !== '') { ?>
                    <div class="alert alert-<?php echo $messageType; ?>"><?php echo htmlspecialchars($message); ?></div>
                <?php } ?>

                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(app_get_csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">
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
                                        <div class="user-file-picker">
                                            <input type="file" name="profile_image" id="profile_image" class="d-none" accept=".jpg,.jpeg,.png,.webp">
                                            <button type="button" class="btn btn-outline-secondary user-file-btn" id="profile_file_btn">Choose File</button>
                                            <input type="text" class="form-control user-file-name" id="profile_file_name" value="No file chosen" readonly>
                                        </div>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    var fileInput = document.getElementById('profile_image');
    var fileButton = document.getElementById('profile_file_btn');
    var fileName = document.getElementById('profile_file_name');

    if (!fileInput || !fileButton || !fileName) {
        return;
    }

    fileButton.addEventListener('click', function () {
        fileInput.click();
    });

    fileInput.addEventListener('change', function () {
        if (fileInput.files && fileInput.files.length > 0) {
            fileName.value = fileInput.files[0].name;
        } else {
            fileName.value = 'No file chosen';
        }
    });
});
</script>
<?php include_once(__DIR__ . '/layout/main_footer.php'); ?>

