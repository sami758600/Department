<?php 
include_once('layout/main_header.php');
require_once("../libraries/functions.class.php");

$fcObj = new DataFunctions();
$tbComments = TB_COMMENTS;

/* Get Messages */
$chairman  = $fcObj->getComment($tbComments, CHAIRMAN);
$principal = $fcObj->getComment($tbComments, PRINCIPAL);
$hod       = $fcObj->getComment($tbComments, HOD);

/* Safe Defaults */
$chairman  = $chairman[0]  ?? [];
$principal = $principal[0] ?? [];
$hod       = $hod[0]       ?? [];

?>

<div class="container-fluid py-4">

    <!-- Page Title -->
    <h2 class="mb-4 fw-bold text-dark">
        AIML Department Dashboard
    </h2>


    <div class="row g-4">

        <!-- Chairman -->
        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body p-4">

                    <h5 class="text-primary fw-semibold mb-3">
                        Chairman Message
                    </h5>

                    <p class="text-muted fst-italic">
                        "<?php echo $chairman['comment'] ?? 'No message available'; ?>"
                    </p>


                    <div class="d-flex align-items-center mt-4 pt-3 border-top">

                        <img src="../images/<?php echo $chairman['image'] ?? 'default.png'; ?>"
                             class="rounded-circle me-3"
                             width="60"
                             height="60"
                             onerror="this.src='../images/default.png'">

                        <div>

                            <div class="fw-semibold text-dark">
                                <?php echo $chairman['name'] ?? 'Not Assigned'; ?>
                            </div>

                            <small class="text-muted">
                                <?php echo $chairman['designation'] ?? ''; ?>
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Principal -->
        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body p-4">

                    <h5 class="text-success fw-semibold mb-3">
                        Principal Message
                    </h5>

                    <p class="text-muted fst-italic">
                        "<?php echo $principal['comment'] ?? 'No message available'; ?>"
                    </p>


                    <div class="d-flex align-items-center mt-4 pt-3 border-top">

                        <img src="../images/<?php echo $principal['image'] ?? 'default.png'; ?>"
                             class="rounded-circle me-3"
                             width="60"
                             height="60"
                             onerror="this.src='../images/default.png'">

                        <div>

                            <div class="fw-semibold text-dark">
                                <?php echo $principal['name'] ?? 'Not Assigned'; ?>
                            </div>

                            <small class="text-muted">
                                <?php echo $principal['designation'] ?? ''; ?>
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- HOD -->
        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body p-4">

                    <h5 class="text-danger fw-semibold mb-3">
                        HOD Message
                    </h5>

                    <p class="text-muted fst-italic">
                        "<?php echo $hod['comment'] ?? 'No message available'; ?>"
                    </p>


                    <div class="d-flex align-items-center mt-4 pt-3 border-top">

                        <img src="../images/<?php echo $hod['image'] ?? 'default.png'; ?>"
                             class="rounded-circle me-3"
                             width="60"
                             height="60"
                             onerror="this.src='../images/default.png'">

                        <div>

                            <div class="fw-semibold text-dark">
                                <?php echo $hod['name'] ?? 'Not Assigned'; ?>
                            </div>

                            <small class="text-muted">
                                <?php echo $hod['designation'] ?? ''; ?>
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include_once('layout/footer.php'); ?>
