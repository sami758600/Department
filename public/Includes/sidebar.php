<?php
    $tbHighLights = TB_HIGHLIGHTS;

    $HighLights = $fcObj->getHighLights($tbHighLights, anu);
    $HighCnt = count($HighLights);

    $itDepHighLights = $fcObj->getHighLights($tbHighLights, DEPARTMENT);
    $itDeptHighCnt = count($itDepHighLights);
?>

<!-- Quick Links -->
<div class="card shadow-sm mb-4 quick-panel-card">
    <div class="card-header fw-semibold quick-panel-head">
        Quick Links
    </div>
    <div class="list-group list-group-flush">
        <a href="<?php echo BASE_URL; ?>/public/pages/Academics/timetables.php" class="list-group-item list-group-item-action quick-panel-link">
            Time Tables
        </a>
        <a href="<?php echo BASE_URL; ?>/public/pages/department/univacedcal.php" class="list-group-item list-group-item-action quick-panel-link">
            University Academic Calendar
        </a>
        <a href="<?php echo BASE_URL; ?>/public/pages/department/itacedcal.php" class="list-group-item list-group-item-action quick-panel-link">
            Department Academic Calendar
        </a>
    </div>
</div>

<!-- AIML Highlights -->
<div class="card shadow-sm mb-4 quick-panel-card">
    <div class="card-header fw-semibold quick-panel-head">
        AIML Highlights
    </div>
    <div class="card-body p-2 quick-panel-body">
        <marquee behavior="scroll"
                 direction="up"
                 scrollamount="1"
                 onmouseover="this.stop();"
                 onmouseout="this.start();"
                 height="140">

            <ul class="list-unstyled mb-0 small quick-panel-points">
                <?php for ($i = 0; $i < $HighCnt; $i++) { ?>
                    <li class="mb-2">
                        &bull; <?php echo $HighLights[$i]['high_light']; ?>
                    </li>
                <?php } ?>
            </ul>

        </marquee>
    </div>
</div>

<!-- Department Highlights -->
<div class="card shadow-sm mb-4 quick-panel-card">
    <div class="card-header fw-semibold quick-panel-head">
        Department Highlights
    </div>
    <div class="card-body p-2 quick-panel-body">
        <marquee behavior="scroll"
                 direction="up"
                 scrollamount="1"
                 onmouseover="this.stop();"
                 onmouseout="this.start();"
                 height="140">

            <ul class="list-unstyled mb-0 small quick-panel-points">
                <?php for ($i = 0; $i < $itDeptHighCnt; $i++) { ?>
                    <li class="mb-2">
                        &bull; <?php echo $itDepHighLights[$i]['high_light']; ?>
                    </li>
                <?php } ?>
            </ul>

        </marquee>
    </div>
</div>
