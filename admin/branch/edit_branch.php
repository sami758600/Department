<?php require_once(__DIR__ . '/../../config.php'); ?>

<?php 

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbStream = TB_STREAM;


/* ---------- Default Safe Value ---------- */
$branchDet = [
    [
        'stream_code' => '',
        'stream_name' => '',
        'id' => ''
    ]
];


/* ---------- Get Branch ---------- */
if (isset($_GET['branch'])) {

    $branchId = intval($_GET['branch']);

    $data = $fcObj->getBranchById($tbStream, $branchId);

    if (!empty($data)) {
        $branchDet = $data;
    }
}


/* ---------- Update Branch ---------- */
if (isset($_POST['editBranch'])) {

    $varArray['branch_id'] = intval($_POST['branchId']);

    $varArray['branch_code'] = $_POST['branchCode'];			
    $varArray['branch_name'] = $_POST['branchName'];

    $editBranch = $fcObj->editBranch($tbStream, $varArray);

    if ($editBranch) {

        header('Location: branch.php');
        exit;

    } else {

        $data = $fcObj->getBranchById($tbStream, intval($_POST['branchId']));

        if (!empty($data)) {
            $branchDet = $data;
        }

        $msg = 'Sorry, Please try again';
    }
}

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

                <?php if (isset($msg)) { ?>
                    <div class="comteeMemRow">
                        <div class="usersDetHeader">
                            <?php echo $msg; ?>
                        </div>
                    </div>
                <?php } ?>


                <form id='editclass' action='edit_branch.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">


                    <!-- Branch Code -->
                    <div class="form_row">
                        <div class="form_label">
                            <label for="branchcode">Branch Code :</label>
                        </div>

                        <div class="form_field">
                            <input type="text" name="branchCode" id="branchCode"
                                   value="<?php echo $branchDet[0]['stream_code']; ?>" />
                        </div>
                    </div>


                    <!-- Branch Name -->
                    <div class="form_row">
                        <div class="form_label">
                            <label for="branchname">Branch Name :</label>
                        </div>

                        <div class="form_field">
                            <input type="text" name="branchName" id="branchName"
                                   value="<?php echo $branchDet[0]['stream_name']; ?>" />
                        </div>
                    </div>


                    <!-- Submit -->
                    <div class="form_row">
                        <div class="form_label"></div>

                        <div class="form_field">

                            <input type="hidden" name="branchId" id="branchId"
                                   value="<?php echo $branchDet[0]['id']; ?>" />

                            <input type='submit' name='editBranch'
                                   class="button"
                                   value='Update Branch' />

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
