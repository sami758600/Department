<?php require_once(__DIR__ . '/../../config.php');?>
<?php
session_start();

if (!isset($_SESSION['adminId'])) {
    header("Location: ../index.php");
    exit;
}

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbStaffCateg = TB_STAFF_CATEGORY;
$tbStaff      = TB_STAFF;

/* ---------------- GET STAFF DETAILS ---------------- */
if (isset($_GET['staff'])) {
    $staffId = (int)$_GET['staff'];
    $staffDetails = $fcObj->getStaffDetailsById($tbStaff, $staffId);
}

/* ---------------- UPDATE STAFF ---------------- */
if (isset($_POST['editStaffDetails'])) {

    $varArray['staffType']     = $_POST['staffType'];
    $varArray['firstName']     = $_POST['firstName'];
    $varArray['lastName']      = $_POST['lastName'];
    $varArray['staffQualif']   = $_POST['staffQualif'];
    $varArray['staffDesig']    = $_POST['staffDesig'];
    $varArray['email']         = $_POST['email'];

    $varArray['indusExp']      = $_POST['indusExp'];
    $varArray['teachingExp']   = $_POST['teachingExp'];
    $varArray['research']      = $_POST['research'];

    $varArray['pub_nat']       = $_POST['pub_nat'];
    $varArray['pub_internat']  = $_POST['pub_internat'];

    $varArray['conf_nat']      = $_POST['conf_nat'];
    $varArray['conf_internat'] = $_POST['conf_internat'];

    $previousImage = $_POST['imageName'];
    $staffId       = $_POST['staffId'];

    if ($_FILES['staffImage']['error'] == 0) {

        if (file_exists("../../public/assets/images/staff/" . $previousImage)) {
            unlink("../../public/assets/images/staff/" . $previousImage);
        }

        $userName = $_POST['firstName'] . $_POST['lastName'];
        $fileName = strtolower(str_replace(' ', '', $userName)) . '.png';

        if (move_uploaded_file($_FILES['staffImage']['tmp_name'], "../../public/assets/images/staff/" . $fileName)) {
            $varArray['image'] = $fileName;
        } else {
            $varArray['image'] = '';
        }

    } else {
        $varArray['image'] = $previousImage;
    }

    $editStaff = $fcObj->editStaffDetails($tbStaff, $staffId, $varArray);

    if ($editStaff !== false) {
        header('Location: ../department/department.php');
        exit;
    } else {
        $msg = "Update failed. Please try again.";
    }
}

include_once('../layout/main_header.php');

$staffCateg = $fcObj->getStaffCategories($tbStaffCateg);
$staffCatCnt = sizeof($staffCateg);
?>

<h3 class="mb-4 fw-bold">Edit Staff</h3>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <?php if (isset($msg)) { ?>
            <div class="alert alert-danger"><?php echo $msg; ?></div>
        <?php } ?>

        <?php if (isset($staffDetails)) { ?>

        <form action="editstaff.php" method="POST" enctype="multipart/form-data">

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Staff Type</label>
                    <select name="staffType" class="form-select" required>
                        <?php for ($i = 0; $i < $staffCatCnt; $i++) { ?>
                            <option value="<?php echo $staffCateg[$i]['id']; ?>"
                                <?php if ($staffDetails[0]['staff_categ_id'] == $staffCateg[$i]['id']) echo "selected"; ?>>
                                <?php echo $staffCateg[$i]['category_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?php echo $staffDetails[0]['e_mail']; ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" name="firstName" class="form-control"
                           value="<?php echo $staffDetails[0]['first_name']; ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lastName" class="form-control"
                           value="<?php echo $staffDetails[0]['last_name']; ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Qualification</label>
                    <input type="text" name="staffQualif" class="form-control"
                           value="<?php echo $staffDetails[0]['qualification']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Designation</label>
                    <input type="text" name="staffDesig" class="form-control"
                           value="<?php echo $staffDetails[0]['designation']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Industry Experience</label>
                    <input type="text" name="indusExp" class="form-control"
                           value="<?php echo $staffDetails[0]['industry_exp']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Teaching Experience</label>
                    <input type="text" name="teachingExp" class="form-control"
                           value="<?php echo $staffDetails[0]['teach_exp']; ?>">
                </div>

                <div class="col-12">
                    <label class="form-label">Research</label>
                    <textarea name="research" class="form-control" rows="3"><?php echo $staffDetails[0]['research']; ?></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">National Publications</label>
                    <textarea name="pub_nat" class="form-control" rows="3"><?php echo $staffDetails[0]['publ_national']; ?></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">International Publications</label>
                    <textarea name="pub_internat" class="form-control" rows="3"><?php echo $staffDetails[0]['publ_international']; ?></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">National Conferences</label>
                    <textarea name="conf_nat" class="form-control" rows="3"><?php echo $staffDetails[0]['conf_national']; ?></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">International Conferences</label>
                    <textarea name="conf_internat" class="form-control" rows="3"><?php echo $staffDetails[0]['conf_international']; ?></textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Staff Image</label>
                    <input type="file" name="staffImage" class="form-control">
                    <input type="hidden" name="imageName" value="<?php echo $staffDetails[0]['image']; ?>">
                </div>

            </div>

            <input type="hidden" name="staffId" value="<?php echo $staffId; ?>">

            <div class="mt-4">
                <button type="submit" name="editStaffDetails" class="btn btn-primary">
                    Update Staff
                </button>
                <a href="../department/department.php" class="btn btn-secondary">
                    Cancel
                </a>
            </div>

        </form>

        <?php } ?>

    </div>
</div>

<?php include_once('../layout/footer.php'); ?>
