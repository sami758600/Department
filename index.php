<?php 
require_once(__DIR__ . '/config.php');

include_once(INCLUDES_PATH . '/header.php');
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbComments = TB_COMMENTS;

$chirmanComment = $fcObj->getComment($tbComments, CHAIRMAN);
$HodComment     = $fcObj->getComment($tbComments, HOD);
$princComment   = $fcObj->getComment($tbComments, PRINCIPAL);
?>

<div class="container my-5">

    <!-- Welcome Section -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-3">Welcome to AIML Department</h2>
            <p class="text-muted fs-6">
               Artificial Intelligence and Machine Learning are transforming every industry — from healthcare and finance to robotics and smart systems. Our AIML department focuses on building strong theoretical foundations combined with practical implementation, enabling students to design intelligent systems that solve real-world problems.
            </p>
        </div>

        <div class="col-lg-4">
            <?php include_once('public/includes/sidebar.php'); ?>
        </div>
    </div>

    <!-- Chairman Comment -->
    <?php if (!empty($chirmanComment)) { ?>
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <p class="fst-italic fs-6">
                    “<?php echo $chirmanComment[0]['comment']; ?>”
                </p>

                <div class="d-flex align-items-center mt-3">
                    <img 
                        src="images/<?php echo $chirmanComment[0]['image']; ?>" 
                        class="rounded-circle me-3"
                        width="80" 
                        height="80"
                        alt="Chairman"
                    >
                    <div>
                        <div class="fw-semibold">
                            <?php echo $chirmanComment[0]['name']; ?>
                        </div>
                        <div class="text-muted small">
                            <?php echo str_replace('\,', ',', $chirmanComment[0]['designation']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Principal Comment -->
    <?php if (!empty($princComment)) { ?>
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <p class="fst-italic fs-6">
                    “<?php echo $princComment[0]['comment']; ?>”
                </p>

                <div class="d-flex align-items-center mt-3">
                    <img 
                        src="images/<?php echo $princComment[0]['image']; ?>" 
                        class="rounded-circle me-3"
                        width="80" 
                        height="80"
                        alt="Principal"
                    >
                    <div>
                        <div class="fw-semibold">
                            <?php echo $princComment[0]['name']; ?>
                        </div>
                        <div class="text-muted small">
                            <?php echo str_replace('\,', ',', $princComment[0]['designation']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- HOD Comment -->
    <?php if (!empty($HodComment)) { ?>
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <p class="fst-italic fs-6">
                    “<?php echo $HodComment[0]['comment']; ?>”
                </p>

                <div class="d-flex align-items-center mt-3">
                    <img 
                        src="images/<?php echo $HodComment[0]['image']; ?>" 
                        class="rounded-circle me-3"
                        width="80" 
                        height="80"
                        alt="HOD"
                    >
                    <div>
                        <div class="fw-semibold">
                            <?php echo $HodComment[0]['name']; ?>
                        </div>
                        <div class="text-muted small">
                            <?php echo str_replace('\,', ',', $HodComment[0]['designation']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>
