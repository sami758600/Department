<?php 
require_once(__DIR__ . '/../../../config.php');

include_once(INCLUDES_PATH . '/header.php');
require_once(LIB_PATH . '/functions.class.php');


$fcObj = new DataFunctions();

$tbStaffCateg = TB_STAFF_CATEGORY;
$tbStaff      = TB_STAFF;

$staffCateg   = $fcObj->getStaffCategories($tbStaffCateg);
$categoryCnt  = sizeof($staffCateg);

for($i=0; $i<$categoryCnt; $i++){
    $categoryId = $staffCateg[$i]['id'];
    $staffDetails[$i] = $fcObj->getStaffDetails($tbStaff, $categoryId);
}
?>

<div class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">AIML Department Faculty</h2>
        <p class="text-muted">Meet our experienced and professional teaching staff</p>
    </div>

    <?php for($j=0; $j < $categoryCnt; $j++) { ?>

        <div class="mb-5">
            <h4 class="mb-4 border-start border-4 border-warning ps-3">
                <?php echo $staffCateg[$j]['category_name']; ?>
            </h4>

            <div class="row g-4">

                <?php
                $catStafCnt = sizeof($staffDetails[$j]);

                for($k=0; $k<$catStafCnt; $k++) {

                    $image = $staffDetails[$j][$k]['image'];
                    $name  = $staffDetails[$j][$k]['first_name'];
                ?>

                <div class="col-md-4 col-lg-3">
                    <div class="card shadow-sm border-0 h-100 text-center">

                        <div class="pt-4">
                            <a href="view_staff.php?staff=<?php echo $staffDetails[$j][$k]['id']; ?>">
                                <img 
                                    src="images/staff/<?php echo $image; ?>" 
                                    class="rounded-circle shadow"
                                    width="120"
                                    height="120"
                                    style="object-fit:cover;"
                                >
                            </a>
                        </div>

                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">
                                <?php echo $name; ?>
                            </h6>

                            <div class="small text-muted">
                                <?php echo str_replace('\,', ',', $staffDetails[$j][$k]['qualification']); ?>
                            </div>

                            <div class="small text-warning fw-semibold">
                                <?php echo $staffDetails[$j][$k]['designation']; ?>
                            </div>
                        </div>

                    </div>
                </div>

                <?php } ?>

            </div>
        </div>

    <?php } ?>

</div>

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>
