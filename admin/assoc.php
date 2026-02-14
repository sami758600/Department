<?php 
include_once('main_header.php');
require_once("../libraries/functions.class.php");

$fcObj = new DataFunctions();

$tbComtCtg = TB_COMT_CATEG;
$tbComt    = TB_COMMITTEE;

$ComtCateg = $fcObj->getComiteCatg($tbComtCtg);
$categoryCnt = sizeof($ComtCateg);

$CmtMemDet = array();

for ($i = 0; $i < $categoryCnt; $i++) {
    $categoryId = $ComtCateg[$i]['id'];
    $CmtMemDet[$i] = $fcObj->getCmtMembers($tbComt, $categoryId);
}
?>

<h3 class="mb-4 fw-bold">MBA Association Committee</h3>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <?php if ($categoryCnt > 0) { ?>

            <?php for ($j = 0; $j < $categoryCnt; $j++) { ?>

                <h5 class="mt-4 mb-3 text-primary">
                    <?php echo $ComtCateg[$j]['category_name']; ?>
                </h5>

                <div class="row g-4">

                    <?php if (!empty($CmtMemDet[$j])) { ?>

                        <?php foreach ($CmtMemDet[$j] as $member) { ?>

                            <div class="col-md-4 col-lg-3">
                                <div class="card shadow-sm border-0 text-center h-100">

                                    <div class="card-body">

                                        <img 
                                            src="../images/users/<?php echo $member['image']; ?>"
                                            class="rounded-circle mb-3"
                                            width="100"
                                            height="100"
                                            alt="<?php echo $member['firstname'].' '.$member['lastname']; ?>"
                                            style="object-fit: cover;"
                                        >

                                        <h6 class="fw-semibold mb-1">
                                            <?php echo $member['firstname'].' '.$member['lastname']; ?>
                                        </h6>

                                        <p class="text-muted small mb-1">
                                            <?php echo $member['section_name']; ?>
                                        </p>

                                    </div>

                                </div>
                            </div>

                        <?php } ?>

                    <?php } else { ?>

                        <div class="col-12 text-muted">
                            No members assigned for this category.
                        </div>

                    <?php } ?>

                </div>

            <?php } ?>

        <?php } else { ?>

            <p class="text-muted">No committee categories found.</p>

        <?php } ?>

        <div class="mt-5">
            <a href="addmem.php" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i>
                Add Committee Member
            </a>
        </div>

    </div>
</div>

<?php include_once('footer.php'); ?>
