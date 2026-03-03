<?php require_once(__DIR__ . '/../../config.php');

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();
$tbHighLights = TB_HIGHLIGHTS;

$aimlHighlights = $fcObj->getHighLights($tbHighLights, AIML);
$deptHighlights = $fcObj->getHighLights($tbHighLights, DEPARTMENT);

include_once('../layout/main_header.php');
include_once('../layout/core_forms_style.php');
?>
<div id="page">
    <div id="content">
        <div class="post">
            <span class="alignCenter">
                <h4>AIML Department </h4>
            </span>
            <p></p>
        </div>
        <div id='content_left' class='content_left'>
            <?php include_once('../layout/other_leftnav.php'); ?>
        </div>
        <div id='content_right' class='content_right'>
            <div class="comteeMem">
                <div class="committeeTitle">
                    <div class='eventCandName'>AIML Highlights</div>
                </div>
                <?php foreach ($aimlHighlights as $row) { ?>
                    <div class="usersDetHeader">
                        <div class='eventCandName'><?php echo $row['high_light']; ?></div>
                        <div class='eventCandName'>
                            <a href="delete_highLight.php?highlight=<?php echo $row['id']; ?>" onclick="return confirm('Do You Want To Continue To Delete');">
                                <input type="button" class="button" value="Delete" />
                            </a>
                        </div>
                    </div>
                    <br class="clearfix" />
                <?php } ?>
            </div>

            <div class="comteeMem">
                <div class="committeeTitle">
                    <div class='eventCandName'>Department Highlights</div>
                </div>
                <?php foreach ($deptHighlights as $row) { ?>
                    <div class="usersDetHeader">
                        <div class='eventCandName'><?php echo $row['high_light']; ?></div>
                        <div class='eventCandName'>
                            <a href="delete_highLight.php?highlight=<?php echo $row['id']; ?>" onclick="return confirm('Do You Want To Continue To Delete');">
                                <input type="button" class="button" value="Delete" />
                            </a>
                        </div>
                    </div>
                    <br class="clearfix" />
                <?php } ?>
            </div>

            <div class="eventCandName">
                <a href="add_highlight.php">
                    <input type="button" class="button" value="Add Highlight" />
                </a>
            </div>
        </div>
        <br class="clearfix" />
    </div>
    <?php include_once('../layout/sidebar.php'); ?>
    <br class="clearfix" />
</div>
</div>
<?php include_once('../layout/footer.php'); ?>
