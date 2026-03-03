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
$staffForm = array();

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

$staffForm = array(
    'staffType' => isset($_POST['staffType']) ? (string)$_POST['staffType'] : '',
    'email' => isset($_POST['email']) ? (string)$_POST['email'] : '',
    'firstName' => isset($_POST['firstName']) ? (string)$_POST['firstName'] : '',
    'lastName' => isset($_POST['lastName']) ? (string)$_POST['lastName'] : '',
    'staffQualif' => isset($_POST['staffQualif']) ? (string)$_POST['staffQualif'] : '',
    'staffDesig' => isset($_POST['staffDesig']) ? (string)$_POST['staffDesig'] : '',
    'indusExp' => isset($_POST['indusExp']) ? (string)$_POST['indusExp'] : '',
    'teachingExp' => isset($_POST['teachingExp']) ? (string)$_POST['teachingExp'] : '',
    'research' => isset($_POST['research']) ? (string)$_POST['research'] : '',
    'pub_nat' => isset($_POST['pub_nat']) ? (string)$_POST['pub_nat'] : '',
    'pub_internat' => isset($_POST['pub_internat']) ? (string)$_POST['pub_internat'] : '',
    'conf_nat' => isset($_POST['conf_nat']) ? (string)$_POST['conf_nat'] : '',
    'conf_internat' => isset($_POST['conf_internat']) ? (string)$_POST['conf_internat'] : ''
);

include_once('../layout/main_header.php');

$staffCateg = $fcObj->getStaffCategories($tbStaffCateg);
?>

<style type="text/css">
    .add-staff-page .form-shell {
        max-width: none;
        margin: 0;
        width: 100%;
    }

    .add-staff-page .page-hero {
        border: 1px solid #cfdced;
        border-radius: 18px;
        padding: 18px 22px;
        background:
            linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 18px;
    }

    .add-staff-page .staff-title {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
        margin: 0;
    }

    .add-staff-page .staff-subtitle {
        margin: 8px 0 0;
        color: #556a84;
        font-size: 15px;
    }

    .add-staff-page .staff-form-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
        background: #ffffff;
    }

    .add-staff-page .staff-form-card .card-body {
        padding: 22px;
    }

    .add-staff-page .section-title {
        font-size: 15px;
        font-weight: 800;
        color: #19436f;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin: 2px 0 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .add-staff-page .section-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0f766e, #2563eb);
        display: inline-block;
    }

    .add-staff-page .section-box {
        border: 1px solid #dce7f3;
        border-radius: 14px;
        background: #f8fbff;
        padding: 14px;
        margin-bottom: 12px;
    }

    .add-staff-page .form-label {
        font-weight: 700;
        color: #1f324b;
        font-size: 15px;
        margin-bottom: 6px;
    }

    .add-staff-page .form-control,
    .add-staff-page .form-select {
        border: 1px solid #c8d8ea;
        border-radius: 12px;
        min-height: 50px;
        background: #f6faff;
        font-size: 16px;
    }

    .add-staff-page textarea.form-control {
        min-height: 108px;
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
        padding: 11px 20px;
        background: linear-gradient(135deg, #102a48, #123b66);
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
    }

    .add-staff-page .btn-secondary {
        border-radius: 12px;
        padding: 11px 20px;
        font-weight: 600;
    }

    .add-staff-page .upload-help {
        margin-top: 8px;
        color: #6b7f98;
        font-size: 13px;
    }

    .add-staff-page .action-bar {
        margin-top: 16px;
        border: 1px solid #dce7f3;
        border-radius: 14px;
        background: #f8fbff;
        padding: 12px;
    }

    @media (max-width: 768px) {
        .add-staff-page .staff-title {
            font-size: 26px;
        }
    }
</style>

<div class="container-fluid add-staff-page">
    <div class="form-shell">

    <div class="page-hero">
        <h4 class="staff-title">Add New Staff</h4>
        <p class="staff-subtitle">Create a complete profile including qualifications, experience, and publications.</p>
    </div>

    <?php if (isset($msg)) { ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php } ?>

    <div class="card staff-form-card border-0">
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="section-title"><span class="section-dot"></span>Basic Details</div>
                <div class="section-box">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Staff Type</label>
                        <select name="staffType" class="form-select" required>
                            <option value="">Select</option>
                            <?php foreach ($staffCateg as $cat) { ?>
                                <?php $catId = (string)$cat['id']; ?>
                                <option value="<?php echo htmlspecialchars($catId, ENT_QUOTES, 'UTF-8'); ?>" <?php if ($staffForm['staffType'] === $catId) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars((string)$cat['category_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($staffForm['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" value="<?php echo htmlspecialchars($staffForm['firstName'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" value="<?php echo htmlspecialchars($staffForm['lastName'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Qualification</label>
                        <input type="text" name="staffQualif" class="form-control" value="<?php echo htmlspecialchars($staffForm['staffQualif'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <input type="text" name="staffDesig" class="form-control" value="<?php echo htmlspecialchars($staffForm['staffDesig'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                </div>
                </div>

                <div class="section-title"><span class="section-dot"></span>Academic Profile</div>
                <div class="section-box">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Industry Experience</label>
                        <input type="text" name="indusExp" class="form-control" value="<?php echo htmlspecialchars($staffForm['indusExp'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Teaching Experience</label>
                        <input type="text" name="teachingExp" class="form-control" value="<?php echo htmlspecialchars($staffForm['teachingExp'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Research</label>
                        <textarea name="research" class="form-control" rows="3"><?php echo htmlspecialchars($staffForm['research'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">National Publications</label>
                        <textarea name="pub_nat" class="form-control" rows="3"><?php echo htmlspecialchars($staffForm['pub_nat'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">International Publications</label>
                        <textarea name="pub_internat" class="form-control" rows="3"><?php echo htmlspecialchars($staffForm['pub_internat'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">National Conferences</label>
                        <textarea name="conf_nat" class="form-control" rows="3"><?php echo htmlspecialchars($staffForm['conf_nat'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">International Conferences</label>
                        <textarea name="conf_internat" class="form-control" rows="3"><?php echo htmlspecialchars($staffForm['conf_internat'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>
                </div>
                </div>

                    <div class="col-12">
                        <label class="form-label">Staff Image</label>
                        <input type="file" name="staffImage" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                        <div class="upload-help">Allowed: JPG, PNG, WEBP</div>
                    </div>

                    <div class="col-12">
                        <div class="action-bar d-flex gap-2 flex-wrap">
                            <button type="submit" name="addNewStaff" class="btn btn-primary">
                                <i class="bi bi-person-plus me-1"></i> Add Staff
                            </button>
                            <a href="../department/department.php" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>
    </div>

</div>

<?php include_once('../layout/footer.php'); ?>
