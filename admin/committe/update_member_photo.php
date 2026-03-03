<?php require_once(__DIR__ . '/../../config.php'); ?>
<?php
header('Content-Type: application/json');

require_once(LIB_PATH . '/functions.class.php');
$fcObj = new DataFunctions();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
    exit;
}

$userId = isset($_POST['userId']) ? (int)$_POST['userId'] : 0;
if ($userId <= 0) {
    echo json_encode(array('success' => false, 'message' => 'Please select a member first.'));
    exit;
}

if (empty($_FILES['memberPhoto']['name'])) {
    echo json_encode(array('success' => false, 'message' => 'No photo selected.'));
    exit;
}

$allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'webp');
$fileName = $_FILES['memberPhoto']['name'];
$fileTmpPath = $_FILES['memberPhoto']['tmp_name'];
$fileSize = (int)$_FILES['memberPhoto']['size'];
$fileError = (int)$_FILES['memberPhoto']['error'];
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if ($fileError !== 0) {
    echo json_encode(array('success' => false, 'message' => 'Upload failed.'));
    exit;
}

if (!in_array($fileExt, $allowedExt, true)) {
    echo json_encode(array('success' => false, 'message' => 'Invalid format. Use JPG, PNG, GIF, WEBP.'));
    exit;
}

if ($fileSize > 2 * 1024 * 1024) {
    echo json_encode(array('success' => false, 'message' => 'Photo size must be below 2MB.'));
    exit;
}

$newFileName = 'user_' . $userId . '_' . date('YmdHis') . '.' . $fileExt;
$uploadDir = ROOT_PATH . '/public/assets/images/users/';
$uploadPath = $uploadDir . $newFileName;

if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0777, true);
}

if (!move_uploaded_file($fileTmpPath, $uploadPath)) {
    echo json_encode(array('success' => false, 'message' => 'Unable to save uploaded file.'));
    exit;
}

$updated = $fcObj->updateUserImage(TB_USERS, $userId, $newFileName);
if (!$updated) {
    echo json_encode(array('success' => false, 'message' => 'Photo saved but DB update failed.'));
    exit;
}

echo json_encode(array(
    'success' => true,
    'message' => 'Profile photo updated.',
    'image_name' => $newFileName,
    'image_url' => BASE_URL . '/public/assets/images/users/' . $newFileName
));
exit;

