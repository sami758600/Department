
<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
include_once('../layout/main_header.php');

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbStaffCateg = TB_STAFF_CATEGORY;
$tbStaff      = TB_STAFF;

$staffCateg = $fcObj->getStaffCategories($tbStaffCateg);
$categoryCnt = sizeof($staffCateg);

for($i=0; $i<$categoryCnt; $i++){
    $categoryId = $staffCateg[$i]['id'];
    $staffDetails[$i] = $fcObj->getStaffDetails($tbStaff, $categoryId);
}
?>

<style type="text/css">
    .staff-page {
        padding-bottom: 14px;
    }

    .staff-page .page-title {
        font-size: 36px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
        margin: 0;
    }

    .staff-page .add-staff-btn {
        border: 0;
        border-radius: 12px;
        padding: 10px 18px;
        background: linear-gradient(135deg, #1f2937, #111827);
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 8px 16px rgba(17, 24, 39, 0.2);
    }

    .staff-page .add-staff-btn:hover {
        color: #fff;
        filter: brightness(1.06);
    }

    .staff-page .staff-group {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        background: #ffffff;
    }

    .staff-page .staff-group-header {
        background: #f8fafc;
        color: #1f2937;
        font-size: 20px;
        font-weight: 700;
        padding: 14px 18px;
        border-bottom: 1px solid #e5e7eb;
    }

    .staff-page .staff-group-body {
        background: #ffffff;
        padding: 20px;
    }

    .staff-page .staff-card {
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 6px 14px rgba(15, 23, 42, 0.05);
        transition: transform .2s ease, box-shadow .2s ease;
        background: #fff;
    }

    .staff-page .staff-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(15, 23, 42, 0.1);
    }

    .staff-page .staff-image {
        width: 104px;
        height: 104px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #e5e7eb;
    }

    .staff-page .staff-name {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .staff-page .staff-qual {
        color: #64748b;
        font-size: 13px;
        min-height: 40px;
    }

    .staff-page .staff-designation {
        color: #334155;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .staff-page .staff-action {
        border-radius: 10px;
        font-weight: 700;
        padding: 6px 12px;
        font-size: 12px;
    }

    .staff-page .staff-empty {
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        background: #f8fafc;
        color: #64748b;
        font-weight: 600;
        padding: 14px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .staff-page .page-title {
            font-size: 30px;
        }
    }
</style>

<div class="container-fluid staff-page">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title">Department Staff Management</h3>

        <a href="../staff/addstaff.php" class="btn add-staff-btn">
            <i class="bi bi-plus-circle me-1"></i> Add Staff
        </a>
    </div>

    <?php for($j=0; $j<$categoryCnt; $j++) { ?>

        <div class="card staff-group border-0 mb-4">
            <div class="card-header staff-group-header fw-semibold">
                <?php echo $staffCateg[$j]['category_name']; ?>
            </div>

            <div class="card-body staff-group-body">

                <div class="row">

                <?php
                    $catStafCnt = sizeof($staffDetails[$j]);

                    if ($catStafCnt == 0) {
                ?>
                    <div class="col-12">
                        <div class="staff-empty">No staff added in this category yet.</div>
                    </div>
                <?php
                    }

                    for($k=0; $k<$catStafCnt; $k++) {
                        $staff = $staffDetails[$j][$k];
                ?>

                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 staff-card border-0 text-center">

                            <div class="card-body">

                                <img src="../../public/assets/images/staff/<?php echo $staff['image']; ?>"
                                     class="staff-image mb-3"
                                     width="100" height="100"
                                     alt="<?php echo $staff['first_name']; ?>">

                                <h6 class="staff-name">
                                    <?php echo $staff['first_name']; ?>
                                </h6>

                                <div class="staff-qual">
                                    <?php echo str_replace('\,', ',', $staff['qualification']); ?>
                                </div>

                                <div class="staff-designation">
                                    <?php echo $staff['designation']; ?>
                                </div>

                                <div class="d-flex justify-content-center gap-2">
                                    <a href="../staff/editstaff.php?staff=<?php echo $staff['id']; ?>"
                                       class="btn btn-sm btn-outline-primary staff-action">
                                        Edit
                                    </a>

                                    <a href="../staff/delete_staff.php?staff=<?php echo $staff['id']; ?>"
                                       class="btn btn-sm btn-outline-danger staff-action"
                                       onclick="return confirm('Are you sure you want to delete this staff?')">
                                        Delete
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php } ?>

                </div>

            </div>
        </div>

    <?php } ?>

</div>

<?php include_once('../layout/footer.php'); ?>
