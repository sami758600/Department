<?php
    $tbHighLights = TB_HIGHLIGHTS;

    $HighLights = $fcObj->getHighLights($tbHighLights, anu);
    $HighCnt = count($HighLights);

    $itDepHighLights = $fcObj->getHighLights($tbHighLights, DEPARTMENT);
    $itDeptHighCnt = count($itDepHighLights);
?>

<!-- Quick Links -->
<div class="card shadow-sm mb-4">
    <div class="card-header fw-semibold">
        Quick Links
    </div>
    <div class="list-group list-group-flush">
        <a href="../pages/Academics/timetables.php" class="list-group-item list-group-item-action">
            Time Tables
        </a>
        <a href="../pages/department/univacedcal.php" class="list-group-item list-group-item-action">
            University Academic Calendar
        </a>
        <a href="../pages/department/itacedcal.php" class="list-group-item list-group-item-action">
            Department Academic Calendar
        </a>
    </div>
</div>

<!-- MBA Highlights -->
<div class="card shadow-sm mb-4">
    <div class="card-header fw-semibold">
        AIML Highlights
    </div>
    <div class="card-body p-2">
        <marquee behavior="scroll"
                 direction="up"
                 scrollamount="1"
                 onmouseover="this.stop();"
                 onmouseout="this.start();"
                 height="140">

            <ul class="list-unstyled mb-0 small">
                <?php for ($i = 0; $i < $HighCnt; $i++) { ?>
                    <li class="mb-2">
                        • <?php echo $HighLights[$i]['high_light']; ?>
                    </li>
                <?php } ?>
            </ul>

        </marquee>
    </div>
</div>

<!-- Department Highlights -->
<div class="card shadow-sm mb-4">
    <div class="card-header fw-semibold">
        Department Highlights
    </div>
    <div class="card-body p-2">
        <marquee behavior="scroll"
                 direction="up"
                 scrollamount="1"
                 onmouseover="this.stop();"
                 onmouseout="this.start();"
                 height="140">

            <ul class="list-unstyled mb-0 small">
                <?php for ($i = 0; $i < $itDeptHighCnt; $i++) { ?>
                    <li class="mb-2">
                        • <?php echo $itDepHighLights[$i]['high_light']; ?>
                    </li>
                <?php } ?>
            </ul>

        </marquee>
    </div>
</div>
