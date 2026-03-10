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
	#content_left {
		display: none;
	}

	#content {
		grid-template-columns: 1fr;
		gap: 0;
	}

	#page {
		max-width: none;
	}
</style>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>AIML Department </h4>
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'></div>
					<div id='content_right' class='content_right'>
						<div class="comteeMem">
							<?php
								if( isset ( $msg ) ){
							?>
								<div class="comteeMemRow">
									<div class="usersDetHeader">
										<?php echo $msg;?>
									</div>
								</div>
							<?php
								}
							?>
							<form id='editclass' action='edit_batch.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for="batchname">Batch Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="batchName" id="batchName" value="<?php echo $batchDet[0]['batch'];?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type="hidden" name="batchId" id="batchId" value="<?php echo $batchDet[0]['id']; ?>"/>
										<input type='submit' name='editBatch' class="button" value='Update Batch' />
									</div>
								</div>
							</form>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				                <div class="mt-3">
                    <a href="../settings/department_option.php?option=batches" class="btn btn-outline-secondary">Back</a>
                </div><?php 
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('../layout/footer.php');
?>

