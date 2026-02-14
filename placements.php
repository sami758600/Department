<?php 
	include_once('header.php');
?>
<link rel="stylesheet" href="styles/placements.css">
<?php

require_once("libraries/functions.class.php");

$fcObj = new DataFunctions();

$tbPlacements = TB_PLACEMENTS;

$cat_id = NON_DOCUMENT;
$placements = $fcObj->getPlacements($tbPlacements, $cat_id);
$placementsCnt = sizeof($placements);

$cat_id = DOCUMENT;
$placementDocs = $fcObj->getPlacements($tbPlacements, $cat_id);
$placementDocsCnt = sizeof($placementDocs);

?>

<!-- ================= HERO SECTION ================= -->

<div class="placement-hero">
    <div class="hero-content">
        <h1>Placements</h1>
        <p>Empowering careers through industry-leading placement opportunities.</p>
    </div>
</div>

<!-- ================= MAIN CONTENT ================= -->
<div class="container">
    <div class="placement-container">

        <!-- LEFT CONTENT -->
        <div class="placement-left">

            <!-- Placement Highlights -->
            <div class="section-title">Placement Highlights</div>

            <div class="placements-list">

                <?php for($i=0; $i<$placementsCnt; $i++){ ?>
                    <div class="placement-card">
                        <div class="placement-number">
                            <?php echo str_pad($i+1, 2, "0", STR_PAD_LEFT); ?>
                        </div>
                        <div class="placement-text">
                            <?php echo $placements[$i]['placement_desc']; ?>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <!-- Documents Section -->
            <div class="section-title" style="margin-top:50px;">Documents & Reports</div>

            <div class="documents-list">
                <?php for($i=0; $i<$placementDocsCnt; $i++){

                    $placementDoc = $placementDocs[$i]['placement_desc'];
                    $placeDocs = explode('$$',$placementDoc);
                ?>
                    <div class="document-card">
                        <div class="document-title">
                            <?php echo $placeDocs[0]; ?>
                        </div>
                        <div class="document-link">
                            <a href="<?php echo '../uploads/placements/'.$placeDocs[1]; ?>" target="_blank">
                                View Details
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>

        <div class="sidebar-card">
            <h4>MBA DEPARTMENT</h4>
            <ul>
                <li><a href="#">About Department</a></li>
                <li><a href="#">Faculty</a></li>
                <li class="active"><a href="#">Placements</a></li>
                <li><a href="#">Achievements</a></li>
                <li><a href="#">Programs</a></li>
            </ul>
        </div>

        <div class="quick-stats">
             <h5>QUICK STATS</h5>

            <div class="stat-row">
                <div>Students Placed</div>
                <span>95%</span>
            </div>

            <div class="stat-row">
                <div>Top Recruiters</div>
                <span>50+</span>
            </div>

            <div class="stat-row">
                <div>Avg. Package</div>
                <span>₹8.5L</span>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>
