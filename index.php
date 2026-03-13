<?php 
require_once(__DIR__ . '/config.php');

include_once(INCLUDES_PATH . '/header.php');
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbComments = TB_COMMENTS;

$chirmanComment = $fcObj->getComment($tbComments, CHAIRMAN);
$HodComment     = $fcObj->getComment($tbComments, HOD);
$princComment   = $fcObj->getComment($tbComments, PRINCIPAL);
$directorComment = $fcObj->getComment($tbComments, DIRECTOR);
?>

<div class="container my-5 home-shell">

    <!-- Welcome Section -->
    <div class="row mb-5 g-4 align-items-stretch">
        <div class="col-lg-8">
            <div class="home-intro-card h-100">
            <span class="home-kicker">Department Vision</span>
            <h2 class="fw-bold mb-3">Welcome to AIML Department</h2>
            <p class="home-intro-text mb-0">
               Artificial Intelligence and Machine Learning are transforming every industry - from healthcare and finance to robotics and smart systems. Our AIML department focuses on building strong theoretical foundations combined with practical implementation, enabling students to design intelligent systems that solve real-world problems.
            </p>
            </div>
        </div>

        <div class="col-lg-4">
            <?php include_once(INCLUDES_PATH . '/sidebar.php'); ?>
        </div>
    </div>

    <!-- Chairman Comment -->
    <?php if (!empty($chirmanComment)) { ?>
        <div class="card mb-4 shadow-sm border-0 profile-quote-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <img 
                        src="<?php echo BASE_URL; ?>/public/assets/images/<?php echo $chirmanComment[0]['image']; ?>" 
                        class="rounded-circle profile-quote-photo"
                        width="80" 
                        height="80"
                        alt="Chairman"
                    >
                    <div>
                        <div class="fw-semibold profile-quote-name">
                            <?php echo $chirmanComment[0]['name']; ?>
                        </div>
                        <div class="text-muted small profile-quote-role">
                            <?php echo strtoupper(str_replace('\,', ',', $chirmanComment[0]['designation'])); ?>
                        </div>
                    </div>
                </div>

                <p class="fst-italic fs-6 profile-quote-text mt-3 mb-0">
                    <?php echo $chirmanComment[0]['comment']; ?>
                </p>
            </div>
        </div>
    <?php } ?>

    <!-- Principal Comment -->
    <?php if (!empty($princComment)) { ?>
        <div class="card mb-4 shadow-sm border-0 profile-quote-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <img 
                        src="<?php echo BASE_URL; ?>/public/assets/images/<?php echo $princComment[0]['image']; ?>" 
                        class="rounded-circle profile-quote-photo"
                        width="80" 
                        height="80"
                        alt="Principal"
                    >
                    <div>
                        <div class="fw-semibold profile-quote-name">
                            <?php echo $princComment[0]['name']; ?>
                        </div>
                        <div class="text-muted small profile-quote-role">
                            <?php echo strtoupper(str_replace('\,', ',', $princComment[0]['designation'])); ?>
                        </div>
                    </div>
                </div>

                <p class="fst-italic fs-6 profile-quote-text mt-3 mb-0">
                    <?php echo $princComment[0]['comment']; ?>
                </p>
            </div>
        </div>
    <?php } ?>

    <!-- Director Comment -->
    <?php if (!empty($directorComment)) { ?>
        <div class="card mb-4 shadow-sm border-0 profile-quote-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <img 
                        src="<?php echo BASE_URL; ?>/public/assets/images/<?php echo $directorComment[0]['image']; ?>" 
                        class="rounded-circle profile-quote-photo"
                        width="80" 
                        height="80"
                        alt="Director"
                    >
                    <div>
                        <div class="fw-semibold profile-quote-name">
                            <?php echo $directorComment[0]['name']; ?>
                        </div>
                        <div class="text-muted small profile-quote-role">
                            <?php echo strtoupper(str_replace('\,', ',', $directorComment[0]['designation'])); ?>
                        </div>
                    </div>
                </div>

                <p class="fst-italic fs-6 profile-quote-text mt-3 mb-0">
                    <?php echo $directorComment[0]['comment']; ?>
                </p>
            </div>
        </div>
    <?php } ?>

    <!-- HOD Comment -->
    <?php if (!empty($HodComment)) { ?>
        <div class="card mb-4 shadow-sm border-0 profile-quote-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <img 
                        src="<?php echo BASE_URL; ?>/public/assets/images/<?php echo $HodComment[0]['image']; ?>" 
                        class="rounded-circle profile-quote-photo"
                        width="80" 
                        height="80"
                        alt="HOD"
                    >
                    <div>
                        <div class="fw-semibold profile-quote-name">
                            <?php echo $HodComment[0]['name']; ?>
                        </div>
                        <div class="text-muted small profile-quote-role">
                            <?php echo strtoupper(str_replace('\,', ',', $HodComment[0]['designation'])); ?>
                        </div>
                    </div>
                </div>

                <p class="fst-italic fs-6 profile-quote-text mt-3 mb-0">
                    <?php echo $HodComment[0]['comment']; ?>
                </p>
            </div>
        </div>
    <?php } ?>

</div>

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>