<?php 
include_once('main_header.php');
require_once("../libraries/functions.class.php");

$fcObj = new DataFunctions();
$tbComments = TB_COMMENTS;

$chairman = $fcObj->getComment($tbComments, CHAIRMAN);
$principal = $fcObj->getComment($tbComments, PRINCIPAL);
$hod = $fcObj->getComment($tbComments, HOD);
?>

<h3 class="mb-4 fw-bold">MBA Department Dashboard</h3>

<div class="row g-4">

    <!-- Chairman -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="text-primary fw-semibold mb-3">Chairman Message</h5>
                <p class="text-muted">
                    "<?php echo $chairman[0]['comment'] ?? 'No message'; ?>"
                </p>

                <div class="d-flex align-items-center mt-3">
                    <img src="../images/<?php echo $chairman[0]['image'] ?? 'default.png'; ?>"
                         class="rounded-circle me-3"
                         width="60" height="60">

                    <div>
                        <div class="fw-semibold">
                            <?php echo $chairman[0]['name'] ?? ''; ?>
                        </div>
                        <small class="text-muted">
                            <?php echo $chairman[0]['designation'] ?? ''; ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Principal -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="text-success fw-semibold mb-3">Principal Message</h5>
                <p class="text-muted">
                    "<?php echo $principal[0]['comment'] ?? 'No message'; ?>"
                </p>

                <div class="d-flex align-items-center mt-3">
                    <img src="../images/<?php echo $principal[0]['image'] ?? 'default.png'; ?>"
                         class="rounded-circle me-3"
                         width="60" height="60">

                    <div>
                        <div class="fw-semibold">
                            <?php echo $principal[0]['name'] ?? ''; ?>
                        </div>
                        <small class="text-muted">
                            <?php echo $principal[0]['designation'] ?? ''; ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HOD -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="text-danger fw-semibold mb-3">HOD Message</h5>
                <p class="text-muted">
                    "<?php echo $hod[0]['comment'] ?? 'No message'; ?>"
                </p>

                <div class="d-flex align-items-center mt-3">
                    <img src="../images/<?php echo $hod[0]['image'] ?? 'default.png'; ?>"
                         class="rounded-circle me-3"
                         width="60" height="60">

                    <div>
                        <div class="fw-semibold">
                            <?php echo $hod[0]['name'] ?? ''; ?>
                        </div>
                        <small class="text-muted">
                            <?php echo $hod[0]['designation'] ?? ''; ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once('footer.php'); ?>
