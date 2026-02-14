<?php
session_start();

require_once("../libraries/functions.class.php");

$fcObj = new DataFunctions();
$tbGallery = TB_GALLERY;

if (!isset($_SESSION['adminId'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['image'])) {

    $imageId = intval($_GET['image']);

    // 🔹 First get image details
    $sql = "SELECT image_name FROM $tbGallery WHERE id = $imageId";
    $imageData = $fcObj->dbObj->getAllResults($sql);

    if (!empty($imageData)) {

        $fileName = $imageData[0]['image_name'];

        // 🔹 Delete DB record
        $delete = $fcObj->deleteGallery($tbGallery, $imageId);

        if ($delete) {

            $filePath = "../gallery/" . $fileName;

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}

header("Location: gallery.php");
exit;
?>
