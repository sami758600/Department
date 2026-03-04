<?php require_once(__DIR__ . '/../../config.php'); ?>
<?php 

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbClass   = TB_CLASS;
$tbSubject = TB_SUBJECTS;

$classes    = $fcObj->getClassesWOPO($tbClass);
$classesCnt = sizeof($classes);

$subjDet = array();
$subjId = 0;
foreach (array('subject', 'subId', 'id', 'subjectId', 'subjId', 'subjects', 'subj') as $paramName) {
    if (isset($_GET[$paramName]) && $_GET[$paramName] !== '') {
        $subjId = intval($_GET[$paramName]);
        break;
    }
}

if ($subjId > 0) {
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
include_once('../layout/core_forms_style.php');
?>
<style type="text/css">
    #content_left {
        display: none;
    }

    #content.single-panel-layout {
        grid-template-columns: minmax(320px, 840px);
        justify-content: center;
        gap: 0;
    }

    #content.single-panel-layout .post {
        display: none;
    }

    #content.single-panel-layout #content_right {
        grid-column: 1;
        width: 100%;
    }

    .subject-edit-hero {
        width: 100%;
        max-width: 840px;
        border: 1px solid #cfdced;
        border-radius: 18px;
        padding: 18px 22px;
        background:
            linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 16px;
    }

    .subject-edit-title {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
    }

    .subject-edit-subtitle {
        margin: 8px 0 0;
        font-size: 15px;
        color: #556a84;
    }

    #content.single-panel-layout #content_right .comteeMem {
        width: 100%;
        max-width: 840px;
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
        padding: 24px;
    }

    #editsubject.core-form .form_row {
        grid-template-columns: 1fr;
        gap: 8px;
    }

    #editsubject.core-form .form_label {
        min-height: 0;
        display: block;
        margin: 0;
    }

    #editsubject.core-form .form_label label {
        font-size: 16px;
        font-weight: 700;
        color: #1f324b;
    }

    #editsubject.core-form .form_field input[type="text"] {
        width: 100%;
        min-height: 52px;
        border: 1px solid #c8d8ea;
        border-radius: 12px;
        padding: 11px 14px;
        background: #f6faff;
        font-size: 16px;
        outline: none;
    }

    #editsubject.core-form .form_field input[type="text"]:focus {
        border-color: #2563eb;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }

    #editsubject.core-form .form_actions .form_label {
        display: none;
    }

    #editsubject.core-form .form_actions .button,
    .invalid-subject-actions .button {
        border: 0;
        border-radius: 12px;
        padding: 11px 22px;
        background: linear-gradient(135deg, #102a48, #123b66);
        font-size: 18px;
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
    }

    #editsubject.core-form .form_actions .button:hover,
    .invalid-subject-actions .button:hover {
        filter: brightness(1.06);
    }

    .invalid-subject {
        padding: 14px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #0f172a;
        font-size: 16px;
        line-height: 1.4;
    }

    .invalid-subject-actions {
        margin-top: 12px;
    }
</style>

<div id="page">
    <div id="content" class="single-panel-layout">
        <div class="post">
            <span class="alignCenter">
                <h4>AIML Department</h4>
            </span>
        </div>

        <!-- <div id='content_left' class='content_left'>
            <?php include_once('../layout/other_leftnav.php'); ?>
        </div> -->

        <div id='content_right' class='content_right'>
            <div class="subject-edit-hero">
                <h3 class="subject-edit-title">Edit Subject</h3>
                <p class="subject-edit-subtitle">Update class, subject code, and subject name.</p>
            </div>
            <div class="comteeMem">

                <?php if (isset($msg)) { ?>
                    <div class="comteeMemRow">
                        <div class="usersDetHeader">
                            <?php echo $msg; ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($subjDet)) { ?>

                <form id='editsubject' class="core-form" action='edit_subjects.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">

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

                    <div class="form_row form_actions">
                        <div class="form_label"></div>
                        <div class="form_field">
                            <input type="hidden" name="subId" 
                                value="<?php echo intval($subjDet[0]['id']); ?>" />
                            <input type='submit' name='editSubject' class="button" value='Update Subject' />
                        </div>
                    </div>

                </form>

                <?php } else { ?>
                    <div class="invalid-subject">Invalid subject selected. Open this page from the Subjects list.</div>
                    <div class="invalid-subject-actions">
                        <a href="subjects.php">
                            <input type="button" class="button" value="Back to Subjects" />
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>

        <br class="clearfix" />
    </div>

    <?php include_once('../layout/sidebar.php'); ?>

    <br class="clearfix" />
</div>

<?php include_once('../layout/footer.php'); ?>
