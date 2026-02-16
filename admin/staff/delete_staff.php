<?php require_once(__DIR__ . '/../../config.php');?>
<?php
session_start();

if (!isset($_SESSION['adminId'])) {
    header('Location: index.php');
    exit;
}

require_once(LIB_PATH . '/functions.class.php');


$fcObj = new DataFunctions();

$tbStaff = TB_STAFF;

/* ---------------- DELETE STAFF ---------------- */
if (isset($_GET['staff']) && is_numeric($_GET['staff'])) {

    $staffId = intval($_GET['staff']);

    // Get staff details first
    $staffDet = $fcObj->getStaffDetailsById($tbStaff, $staffId);

    if (!empty($staffDet)) {

        // Delete from database
        $deleteStatus = $fcObj->deleteStaff($tbStaff, $staffId);

        if ($deleteStatus) {

            // Delete image file if exists
            $staffImage = $staffDet[0]['image'];

            if (!empty($staffImage)) {
                $imagePath = "../../public/assets/images/staff/" . $staffImage;

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
    }
}

header('Location: ../department/department.php');
exit;
?>
