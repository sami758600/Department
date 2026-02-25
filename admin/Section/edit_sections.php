<?php require_once(__DIR__ . '/../../config.php'); ?>

<?php 

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbClass   = TB_CLASS;
$tbSection = TB_SECTION;


/* ---------------- Get Classes ---------------- */
$classes = $fcObj->getClassesWOPO($tbClass);
$classesCnt = sizeof($classes);


/* ---------------- Get Section Details ---------------- */
$sectionDet = [];

if (isset($_GET['section']) && !empty($_GET['section'])) {

    $secId = intval($_GET['section']); // Security

    $sectionDet = $fcObj->getSectionById($tbSection, $secId);

    if (empty($sectionDet)) {
        die("Invalid Section ID");
    }
}


/* ---------------- Update Section ---------------- */
if (isset($_POST['editSection'])) {

    $varArray = [];

    $varArray['class_id'] = intval($_POST['clsId']);
    $varArray['sec_id']   = intval($_POST['secId']);

    $varArray['sec_name'] = trim($_POST['secName']);
    $varArray['sec_code'] = trim($_POST['secCode']);

    $editSec = $fcObj->editSection($tbSection, $varArray);

    if ($editSec) {

        header('Location: sections.php');
        exit;

    } else {

        $sectionDet = $fcObj->getSectionById($tbSection, intval($_POST['secId']));
        $msg = 'Sorry, Please try again';
    }
}


include_once('../layout/main_header.php');

?>

<div id="page">
    <div id="content">

        <div class="post">
            <span class="alignCenter">
                <h4>AIML Department</h4>
            </span>
            <p></p>
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


                <form id='editsection' action='edit_sections.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">


                    <!-- Class Name -->
                    <div class="form_row">
                        <div class="form_label">
                            <label for="classcode">Class Name :</label>
                        </div>

                        <div class="form_field">

                            <input type="text" name="clsName" id="clsName"
                                value="<?php echo isset($sectionDet[0]['class_code']) ? $sectionDet[0]['class_code'] : ''; ?>"
                                readonly="readonly" />

                            <input type="hidden" name="clsId" id="clsId"
                                value="<?php echo isset($sectionDet[0]['class_id']) ? $sectionDet[0]['class_id'] : ''; ?>" />

                        </div>
                    </div>


                    <!-- Section Code -->
                    <div class="form_row">
                        <div class="form_label">
                            <label for="sectioncode">Section Code :</label>
                        </div>

                        <div class="form_field">

                            <input type="text" name="secCode" id="secCode"
                                value="<?php echo isset($sectionDet[0]['section_code']) ? $sectionDet[0]['section_code'] : ''; ?>" />

                        </div>
                    </div>


                    <!-- Section Name -->
                    <div class="form_row">
                        <div class="form_label">
                            <label for="sectionname">Section Name :</label>
                        </div>

                        <div class="form_field">

                            <input type="text" name="secName" id="secName"
                                value="<?php echo isset($sectionDet[0]['section_name']) ? $sectionDet[0]['section_name'] : ''; ?>" />

                        </div>
                    </div>


                    <!-- Submit -->
                    <div class="form_row">
                        <div class="form_label"></div>

                        <div class="form_field">

                            <input type="hidden" name="secId" id="secId"
                                value="<?php echo isset($sectionDet[0]['id']) ? $sectionDet[0]['id'] : ''; ?>" />

                            <input type='submit' name='editSection' class="button" value='Update Section' />

                        </div>
                    </div>


                </form>

            </div>
        </div>


        <br class="clearfix" />

    </div>


    <?php include_once('../layout/sidebar.php'); ?>


    <br class="clearfix" />
</div>

</div>

<?php include_once('../layout/footer.php'); ?>
