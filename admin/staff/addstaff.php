<?php require_once(__DIR__ . '/../../config.php');?>

<?php
session_start();

if (!isset($_SESSION['adminId'])) {
    header("Location: index.php");
    exit;
}

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbStaffCateg = TB_STAFF_CATEGORY;
$tbStaff      = TB_STAFF;

/* ================= ADD STAFF LOGIC ================= */
if (isset($_POST['addNewStaff'])) {

    $varArray['staffType']     = $_POST['staffType'];
    $varArray['firstName']     = trim($_POST['firstName']);
    $varArray['lastName']      = trim($_POST['lastName']);
    $varArray['staffQualif']   = str_replace(',', '\,', $_POST['staffQualif']);
    $varArray['staffDesig']    = $_POST['staffDesig'];
    $varArray['email']         = $_POST['email'];

    $varArray['indusExp']      = $_POST['indusExp'];
    $varArray['teachingExp']   = $_POST['teachingExp'];
    $varArray['research']      = $_POST['research'];

    $varArray['pub_nat']       = $_POST['pub_nat'];
    $varArray['pub_internat']  = $_POST['pub_internat'];

    $varArray['conf_nat']      = $_POST['conf_nat'];
    $varArray['conf_internat'] = $_POST['conf_internat'];

    /* Image Upload */
    $userName = $_POST['firstName'] . $_POST['lastName'];
    $fileName = strtolower(str_replace(' ', '', $userName)) . '.png';

    if (!empty($_FILES['staffImage']['name'])) {
        move_uploaded_file(
            $_FILES['staffImage']['tmp_name'],
            "../../public/assets/images/staff/" . $fileName
        );
    } else {
        $fileName = '';
    }

    $varArray['image'] = $fileName;

    $addStaff = $fcObj->addStaffDetails($tbStaff, $varArray);

    if ($addStaff) {
        header("Location: ../department/department.php");
        exit;
    } else {
        $msg = "Failed to add staff. Please try again.";
    }
}

include_once('../layout/main_header.php');

$staffCateg = $fcObj->getStaffCategories($tbStaffCateg);
?>

<style type="text/css">
    .add-staff-page .staff-title {
        font-size: 36px;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: #0f172a;
        margin-bottom: 16px;
    }

    .add-staff-page .staff-form-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        background: #ffffff;
    }

    .add-staff-page .form-label {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 6px;
    }

    .add-staff-page .form-control,
    .add-staff-page .form-select {
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        min-height: 46px;
        background: #f8fafc;
    }

    .add-staff-page textarea.form-control {
        min-height: 110px;
    }

    .add-staff-page .form-control:focus,
    .add-staff-page .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        background: #ffffff;
    }

    .add-staff-page .btn-primary {
        border: 0;
        border-radius: 12px;
        padding: 10px 18px;
        background: linear-gradient(135deg, #1f2937, #111827);
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(17, 24, 39, 0.2);
    }

    .add-staff-page .btn-secondary {
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 600;
    }
</style>

<div class="content-area add-staff-page">

    <h4 class="staff-title">Add New Staff</h4>

    <?php if (isset($msg)) { ?>
        <div class="alert alert-danger">
            <?php echo $msg; ?>
        </div>
    <?php } ?>

    <div class="card staff-form-card border-0">
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Staff Type</label>
                        <select name="staffType" class="form-select" required>
                            <option value="">Select</option>
                            <?php foreach ($staffCateg as $cat) { ?>
                                <option value="<?php echo $cat['id']; ?>">
                                    <?php echo $cat['category_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Qualification</label>
                        <input type="text" name="staffQualif" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <input type="text" name="staffDesig" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Industry Experience</label>
                        <input type="text" name="indusExp" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Teaching Experience</label>
                        <input type="text" name="teachingExp" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Research</label>
                        <textarea name="research" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">National Publications</label>
                        <textarea name="pub_nat" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">International Publications</label>
                        <textarea name="pub_internat" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">National Conferences</label>
                        <textarea name="conf_nat" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">International Conferences</label>
                        <textarea name="conf_internat" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Staff Image</label>
                        <input type="file" name="staffImage" class="form-control">
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" name="addNewStaff" class="btn btn-primary">
                            Add Staff
                        </button>
                        <a href="../department/department.php" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once('../layout/footer.php'); ?>
