<?php 
include_once('main_header.php');

require_once("../libraries/functions.class.php");

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

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Department Staff Management</h3>

        <a href="addstaff.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Staff
        </a>
    </div>

    <?php for($j=0; $j<$categoryCnt; $j++) { ?>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light fw-semibold">
                <?php echo $staffCateg[$j]['category_name']; ?>
            </div>

            <div class="card-body">

                <div class="row">

                <?php
                    $catStafCnt = sizeof($staffDetails[$j]);

                    for($k=0; $k<$catStafCnt; $k++) {
                        $staff = $staffDetails[$j][$k];
                ?>

                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 shadow-sm border-0 text-center">

                            <div class="card-body">

                                <img src="../images/staff/<?php echo $staff['image']; ?>"
                                     class="rounded-circle mb-3"
                                     width="100" height="100"
                                     alt="<?php echo $staff['first_name']; ?>">

                                <h6 class="fw-semibold mb-1">
                                    <?php echo $staff['first_name']; ?>
                                </h6>

                                <div class="text-muted small">
                                    <?php echo str_replace('\,', ',', $staff['qualification']); ?>
                                </div>

                                <div class="text-primary small mb-3">
                                    <?php echo $staff['designation']; ?>
                                </div>

                                <div class="d-flex justify-content-center gap-2">
                                    <a href="editstaff.php?staff=<?php echo $staff['id']; ?>"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <a href="delete_staff.php?staff=<?php echo $staff['id']; ?>"
                                       class="btn btn-sm btn-outline-danger"
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

<?php include_once('footer.php'); ?>
