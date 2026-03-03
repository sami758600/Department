<?php require_once(__DIR__ . '/../../config.php');

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();
$tbClass = TB_CLASS;

$classes = $fcObj->getClasses($tbClass);
$classesCnt = sizeof($classes);

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
                    <div class='eventCandName'>Class Name</div>
                </div>
                <?php for ($j = 0; $j < $classesCnt; $j++) { ?>
                    <div class="usersDetHeader">
                        <div class='eventCandName'>
                            <?php echo $classes[$j]['class_name']; ?>
                        </div>
                        <div class="eventCandName">
                            <a href="edit_class.php?class=<?php echo $classes[$j]['id']; ?>">
                                <input type="button" class="button" value="Edit" />
                            </a>
                            <a href="delete_class.php?class=<?php echo $classes[$j]['id']; ?>" onclick="return confirm('Do You Want To Continue To Delete');">
                                <input type="button" class="button" value="Delete" />
                            </a>
                        </div>
                    </div>
                    <br class="clearfix" />
                <?php } ?>
            </div>
            <div class="eventCandName">
                <a href="add_class.php">
                    <input type="button" class="button" value="Add Class" />
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
