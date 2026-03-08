<?php require_once(__DIR__ . '/../../config.php');

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();
$tbBatch = TB_BATCH;

if (isset($_GET['batch']) && !empty($_GET['batch'])) {

	$batchId = (int)$_GET['batch'];

	$batchDet = $fcObj->getBatchById($tbBatch, $batchId);
	if (empty($batchDet)) {
		header('Location: batch.php');
		exit;
	}
}

if (!isset($batchDet) || empty($batchDet)) {
	header('Location: batch.php');
	exit;
}

if (isset($_POST['editBatch'])) {

	$varArray['batch_id'] = $_POST['batchId'];
	$varArray['batch_name'] = $_POST['batchName'];

	$editBatch = $fcObj->editBatch($tbBatch, $varArray);

	if ($editBatch) {

		header('Location: batch.php');
		exit;
	} else {

		$batchDet = $fcObj->getBatchById($tbBatch, $_POST['batchId']);
		$msg = 'Sorry, Please try again';
	}
}

include_once('../layout/main_header.php');
include_once('../layout/core_forms_style.php');
?>

<style type="text/css">
    .edit-batch-page {
        padding-bottom: 22px;
    }

    .edit-batch-page #page {
        max-width: 980px;
    }

    .edit-batch-page #content {
        grid-template-columns: minmax(0, 1fr);
        gap: 18px;
    }

    .edit-batch-page .post {
        margin-bottom: 4px !important;
    }

    .edit-batch-page .post h4 {
        font-size: 34px;
        letter-spacing: -0.6px;
        margin: 0;
    }

    .edit-batch-page .page-subtitle {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    .edit-batch-page #content_right .comteeMem {
        padding: 28px 30px;
        border-radius: 18px;
    }

    .edit-batch-page .edit-form {
        display: grid;
        gap: 16px;
    }

    .edit-batch-page .edit-form .form_row {
        margin: 0 !important;
    }

    .edit-batch-page .edit-form .form_label {
        margin-bottom: 8px !important;
    }

    .edit-batch-page .edit-form .form_label label {
        font-size: 16px;
        font-weight: 800;
    }

    .edit-batch-page .edit-form .form_field input[type="text"] {
        min-height: 60px !important;
        border-radius: 14px !important;
        font-size: 18px !important;
        padding: 12px 16px !important;
    }

    .edit-batch-page .form-actions {
        padding-top: 2px;
    }

    .edit-batch-page .edit-form .form-actions .button {
        min-height: 54px !important;
        border-radius: 14px !important;
        padding: 12px 24px !important;
        font-size: 20px !important;
        width: auto;
        min-width: 220px;
    }

    .edit-batch-page .form-message {
        margin-bottom: 14px;
        padding: 12px 14px;
        border-radius: 11px;
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #b91c1c;
        font-weight: 700;
        font-size: 15px;
    }

    @media (max-width: 980px) {
        .edit-batch-page .post h4 {
            font-size: 30px;
        }

        .edit-batch-page .edit-form .form_label label {
            font-size: 15px;
        }

        .edit-batch-page .edit-form .form_field input[type="text"] {
            min-height: 56px !important;
            font-size: 17px !important;
        }

        .edit-batch-page .edit-form .form-actions .button {
            width: 100%;
            min-width: 0;
            font-size: 19px !important;
            min-height: 56px !important;
        }
    }
</style>

<div class="edit-batch-page">
    <div id="page">
        <div id="content">
            <div class="post">
                <h4>AIML Department</h4>
                <p class="page-subtitle">Update batch details with a clean and focused form.</p>
            </div>

            <div id='content_right' class='content_right'>
                <div class="comteeMem">
                    <?php if (isset($msg)) { ?>
                        <div class="form-message"><?php echo $msg; ?></div>
                    <?php } ?>

                    <form id='editclass' class="edit-form" action='edit_batch.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
                        <div class="form_row">
                            <div class="form_label">
                                <label for="batchName">Batch Name :</label>
                            </div>
                            <div class="form_field">
                                <input type="text" name="batchName" id="batchName"
                                       value="<?php echo htmlspecialchars((string)$batchDet[0]['batch'], ENT_QUOTES, 'UTF-8'); ?>" />
                            </div>
                        </div>

                        <div class="form_row form-actions">
                            <div class="form_field">
                                <input type="hidden" name="batchId" id="batchId"
                                       value="<?php echo (int)$batchDet[0]['id']; ?>"/>
                                <input type='submit' name='editBatch' class="button" value='Update Batch' />
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

<?php 
	include_once('../layout/footer.php');
?>

