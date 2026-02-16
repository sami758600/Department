<?php require_once(__DIR__ . '/../../config.php'); ?>
<?php 

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbClass = TB_CLASS;

$classes    = $fcObj->getClasses($tbClass);
$classesCnt = sizeof($classes);

$classDet = array(); // Prevent undefined variable error

if (isset($_GET['class']) && !empty($_GET['class'])) {

    $clsId    = intval($_GET['class']);
    $classDet = $fcObj->getClassById($tbClass, $clsId);
}

if (isset($_POST['editClass'])) {

    $varArray = array();
    $varArray['class_id']   = intval($_POST['classId']);
    $varArray['class_name'] = trim($_POST['className']);
    $varArray['class_code'] = trim($_POST['classCode']);

    $editClass = $fcObj->editClass($tbClass, $varArray);

    if ($editClass) {

        header('Location: otheroperations.php');
        exit; // stop execution properly

    } else {

        $classDet = $fcObj->getClassById($tbClass, intval($_POST['classId']));
        $msg = 'Sorry, Please try again';
    }
}

include_once('../layout/main_header.php');
?>

<div id="page">
    <div id="content">
        <div class="post">
            <span class="alignCenter">
                <h4>AIML Department </h4>
            </span>
        </div>

        <div id='content_left' class='content_left'>
            <?php include_once('../layout/other_leftnav.php'); ?>
        </div>

        <div id='content_right' class='content_right'>
            <div class="comteeMem">

                <?php if (isset($msg)) { ?>
                    <div class="comteeMemRow">
                        <div class="usersDetHeader">
                            <?php echo $msg; ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($classDet)) { ?>

                <form id='editclass' action='edit_class.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">

                    <div class="form_row">
                        <div class="form_label">
                            <label>Class Code :</label>
                        </div>
                        <div class="form_field">
                            <input type="text" name="classCode" id="classCode"
                                value="<?php echo htmlspecialchars($classDet[0]['class_code']); ?>" />
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_label">
                            <label>Class Name :</label>
                        </div>
                        <div class="form_field">
                            <input type="text" name="className" id="className"
                                value="<?php echo htmlspecialchars($classDet[0]['class_name']); ?>" />
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_label"></div>
                        <div class="form_field">
                            <input type="hidden" name="classId" id="classId"
                                value="<?php echo intval($classDet[0]['id']); ?>" />
                            <input type='submit' name='editClass' class="button" value='Update Class' />
                        </div>
                    </div>

                </form>

                <?php } else { ?>
                    <div class="usersDetHeader">Invalid Class Selected</div>
                <?php } ?>

            </div>
        </div>

        <br class="clearfix" />
    </div>

    <?php include_once('../layout/sidebar.php'); ?>

    <br class="clearfix" />
</div>

<?php include_once('../layout/footer.php'); ?>
