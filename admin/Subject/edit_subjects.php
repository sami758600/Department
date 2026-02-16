<?php require_once(__DIR__ . '/../../config.php'); ?>
<?php 

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbClass   = TB_CLASS;
$tbSubject = TB_SUBJECTS;

$classes    = $fcObj->getClassesWOPO($tbClass);
$classesCnt = sizeof($classes);

$subjDet = array();

if (isset($_GET['subject']) && !empty($_GET['subject'])) {
    
    $subjId  = intval($_GET['subject']);
    $subjDet = $fcObj->getSubjectById($tbSubject, $subjId);
}

if (isset($_POST['editSubject'])) {

    $varArray = array();
    $varArray['class_id']  = intval($_POST['clsId']);
    $varArray['subj_id']   = intval($_POST['subId']);
    $varArray['subj_name'] = trim($_POST['subName']);
    $varArray['subj_code'] = trim($_POST['subCode']);

    $editSubj = $fcObj->editSubject($tbSubject, $varArray);

    if ($editSubj) {
        header('Location: subjects.php');
        exit;
    } else {
        $subjDet = $fcObj->getSubjectById($tbSubject, intval($_POST['subId']));
        $msg = 'Sorry, Please try again';
    }
}

include_once('../layout/main_header.php');
?>

<div id="page">
    <div id="content">
        <div class="post">
            <span class="alignCenter">
                <h4>MBA Department</h4>
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

                <?php if (!empty($subjDet)) { ?>

                <form id='editsubject' action='edit_subjects.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">

                    <div class="form_row">
                        <div class="form_label">
                            <label>Class Name :</label>
                        </div>
                        <div class="form_field">
                            <input type="text" name="clsName" 
                                value="<?php echo htmlspecialchars($subjDet[0]['class_code']); ?>" 
                                readonly="readonly" />
                            <input type="hidden" name="clsId" 
                                value="<?php echo intval($subjDet[0]['class_id']); ?>" />
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_label">
                            <label>Subject Code :</label>
                        </div>
                        <div class="form_field">
                            <input type="text" name="subCode" 
                                value="<?php echo htmlspecialchars($subjDet[0]['sub_code']); ?>" />
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_label">
                            <label>Subject Name :</label>
                        </div>
                        <div class="form_field">
                            <input type="text" name="subName" 
                                value="<?php echo htmlspecialchars($subjDet[0]['sub_name']); ?>" />
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_label"></div>
                        <div class="form_field">
                            <input type="hidden" name="subId" 
                                value="<?php echo intval($subjDet[0]['id']); ?>" />
                            <input type='submit' name='editSubject' class="button" value='Update Subject' />
                        </div>
                    </div>

                </form>

                <?php } else { ?>
                    <div class="usersDetHeader">Invalid Subject Selected</div>
                <?php } ?>

            </div>
        </div>

        <br class="clearfix" />
    </div>

    <?php include_once('../layout/sidebar.php'); ?>

    <br class="clearfix" />
</div>

<?php include_once('../layout/footer.php'); ?>
