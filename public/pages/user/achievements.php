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
$achievementMessage = '';
$achievementMessageType = '';

$userData = $fcObj->userCheck(TB_USERS, $_SESSION['userName']);
if (empty($userData)) {
    header('Location: ' . BASE_URL . '/public/pages/authentication/logout.php');
    exit;
}

$user = $userData[0];
$userFullName = trim($user['firstname'] . ' ' . $user['lastname']);
$studentTag = ($userFullName !== '' ? $userFullName : $user['username']) . ' [' . $user['admission_id'] . ']';

if (isset($_POST['submit_achievement'])) {
    $typeId = isset($_POST['achievement_type']) ? (int)$_POST['achievement_type'] : 0;
    $collegeName = trim((string)$_POST['college_name']);
    $theme = trim((string)$_POST['achievement_theme']);
    $title = trim((string)$_POST['achievement_title']);
    $description = trim((string)$_POST['achievement_text']);
    $contextTag = 'College: ' . $collegeName . ' | Theme: ' . $theme;

    if ($typeId !== DOCUMENT && $typeId !== NON_DOCUMENT) {
        $achievementMessage = 'Please select a valid achievement type.';
        $achievementMessageType = 'danger';
    } elseif ($collegeName === '') {
        $achievementMessage = 'College name is required.';
        $achievementMessageType = 'danger';
    } elseif ($theme === '') {
        $achievementMessage = 'Theme is required.';
        $achievementMessageType = 'danger';
    } elseif ($typeId === DOCUMENT) {
        if ($title === '') {
            $achievementMessage = 'Achievement title is required for document upload.';
            $achievementMessageType = 'danger';
        } elseif (!isset($_FILES['achievement_file']) || !is_uploaded_file($_FILES['achievement_file']['tmp_name'])) {
            $achievementMessage = 'Please choose a file to upload.';
            $achievementMessageType = 'danger';
        } else {
            $originalName = (string)$_FILES['achievement_file']['name'];
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $allowedExtensions = array('pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png');

            if (!in_array($extension, $allowedExtensions, true)) {
                $achievementMessage = 'Only PDF, DOC, DOCX, JPG, JPEG, and PNG files are allowed.';
                $achievementMessageType = 'danger';
            } else {
                $uploadDir = ROOT_PATH . '/public/assets/images/achievements/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $safeAdmission = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$user['admission_id']);
                $fileName = 'achv_' . $safeAdmission . '_' . date('YmdHis') . '_' . mt_rand(1000, 9999) . '.' . $extension;
                $targetFile = $uploadDir . $fileName;

                if (!@move_uploaded_file($_FILES['achievement_file']['tmp_name'], $targetFile)) {
                    $achievementMessage = 'File upload failed. Please try again.';
                    $achievementMessageType = 'danger';
                } else {
                    $varArray = array(
                        'typeId' => DOCUMENT,
                        'achievement_desc' => addslashes($studentTag . ' - ' . $contextTag . ' - ' . $title) . '$$' . $fileName
                    );
                    $saved = $fcObj->addAchievement(TB_ACHIEVEMENTS, $varArray);

                    if ($saved) {
                        $achievementMessage = 'Achievement uploaded successfully. It is now available for recognition.';
                        $achievementMessageType = 'success';
                    } else {
                        @unlink($targetFile);
                        $achievementMessage = 'Unable to save achievement right now. Please try again.';
                        $achievementMessageType = 'danger';
                    }
                }
            }
        }
    } else {
        if ($description === '') {
            $achievementMessage = 'Please add your achievement details.';
            $achievementMessageType = 'danger';
        } else {
            $varArray = array(
                'typeId' => NON_DOCUMENT,
                'achievement_desc' => addslashes($studentTag . ' - ' . $contextTag . ' - ' . $description)
            );
            $saved = $fcObj->addAchievement(TB_ACHIEVEMENTS, $varArray);

            if ($saved) {
                $achievementMessage = 'Achievement submitted successfully. It is now available for recognition.';
                $achievementMessageType = 'success';
            } else {
                $achievementMessage = 'Unable to submit achievement right now. Please try again.';
                $achievementMessageType = 'danger';
            }
        }
    }
}

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
                    <a class="user-side-link active" href="<?php echo BASE_URL; ?>/public/pages/user/achievements.php">Upload Achievement</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/profile.php">Account Settings</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/downloads.php">Downloads</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/authentication/logout.php">Logout</a>
                </nav>
            </aside>
        </div>

        <div class="col-lg-9">
            <div class="user-summary-card user-profile-card user-achievement-card">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <h2 class="user-profile-title mb-0">Upload Achievement</h2>
                    <a href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                </div>

                <?php if ($achievementMessage !== '') { ?>
                    <div class="alert alert-<?php echo $achievementMessageType; ?> py-2 mb-3">
                        <?php echo htmlspecialchars($achievementMessage); ?>
                    </div>
                <?php } ?>

                <form method="POST" enctype="multipart/form-data" id="achievementUploadForm">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Type</label>
                            <select name="achievement_type" id="achievement_type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="<?php echo DOCUMENT; ?>" <?php echo (isset($_POST['achievement_type']) && (int)$_POST['achievement_type'] === DOCUMENT) ? 'selected' : ''; ?>>Document Upload</option>
                                <option value="<?php echo NON_DOCUMENT; ?>" <?php echo (isset($_POST['achievement_type']) && (int)$_POST['achievement_type'] === NON_DOCUMENT) ? 'selected' : ''; ?>>Text Achievement</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">College Name</label>
                            <input type="text" name="college_name" class="form-control" value="<?php echo isset($_POST['college_name']) ? htmlspecialchars((string)$_POST['college_name']) : ''; ?>" placeholder="Enter college name" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Theme</label>
                            <input type="text" name="achievement_theme" class="form-control" value="<?php echo isset($_POST['achievement_theme']) ? htmlspecialchars((string)$_POST['achievement_theme']) : ''; ?>" placeholder="Enter achievement theme" required>
                        </div>

                        <div class="col-12" id="achievement_title_wrap">
                            <label class="form-label">Achievement Title</label>
                            <input type="text" name="achievement_title" class="form-control" value="<?php echo isset($_POST['achievement_title']) ? htmlspecialchars((string)$_POST['achievement_title']) : ''; ?>" placeholder="Example: 1st Prize in Hackathon">
                        </div>

                        <div class="col-12" id="achievement_file_wrap">
                            <label class="form-label">Achievement File</label>
                            <div class="user-file-picker">
                                <input type="file" name="achievement_file" id="achievement_file" class="d-none" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <button type="button" class="btn btn-outline-secondary user-file-btn" id="achievement_file_btn">Choose File</button>
                                <input type="text" class="form-control user-file-name" id="achievement_file_name" value="No file chosen" readonly>
                            </div>
                            <div class="upload-help-text">Allowed: PDF, DOC, DOCX, JPG, JPEG, PNG</div>
                        </div>

                        <div class="col-12 d-none" id="achievement_text_wrap">
                            <label class="form-label">Achievement Details</label>
                            <textarea name="achievement_text" class="form-control" rows="4" placeholder="Describe your achievement in short."><?php echo isset($_POST['achievement_text']) ? htmlspecialchars((string)$_POST['achievement_text']) : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" name="submit_achievement" class="btn btn-warning">Submit Achievement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var typeSelect = document.getElementById('achievement_type');
    var titleWrap = document.getElementById('achievement_title_wrap');
    var fileWrap = document.getElementById('achievement_file_wrap');
    var textWrap = document.getElementById('achievement_text_wrap');
    var fileInput = document.getElementById('achievement_file');
    var fileButton = document.getElementById('achievement_file_btn');
    var fileName = document.getElementById('achievement_file_name');

    if (!typeSelect || !titleWrap || !fileWrap || !textWrap) {
        return;
    }

    function toggleAchievementFields() {
        var selectedType = typeSelect.value;
        if (selectedType === '<?php echo NON_DOCUMENT; ?>') {
            titleWrap.classList.add('d-none');
            fileWrap.classList.add('d-none');
            textWrap.classList.remove('d-none');
        } else {
            titleWrap.classList.remove('d-none');
            fileWrap.classList.remove('d-none');
            textWrap.classList.add('d-none');
        }
    }

    typeSelect.addEventListener('change', toggleAchievementFields);
    toggleAchievementFields();

    if (fileInput && fileButton && fileName) {
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
    }
});
</script>

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>
