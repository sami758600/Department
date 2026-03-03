<?php require_once(__DIR__ . '/../../config.php');

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();
$tbBatch = TB_BATCH;

if (isset($_POST['addNewBatch'])) {

	$varArray['batch_name'] = $_POST['batchName'];

	$addBatch = $fcObj->addBatch($tbBatch, $varArray);

	if ($addBatch) {

		header('Location: batch.php');
		exit;
	} else {
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
		grid-template-columns: minmax(320px, 840px);
		justify-content: center;
		gap: 0;
	}

	.batch-add-hero {
		border: 1px solid #cfdced;
		border-radius: 18px;
		padding: 18px 22px;
		background:
			linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
			#f8fbff;
		box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
		margin-bottom: 16px;
	}

	.batch-add-title {
		margin: 0;
		font-size: 32px;
		font-weight: 800;
		letter-spacing: -0.6px;
		color: #0f172a;
	}

	.batch-add-subtitle {
		margin: 8px 0 0;
		font-size: 15px;
		color: #556a84;
	}

	#content_right .comteeMem {
		max-width: 840px;
		border: 1px solid #d7dde6;
		border-radius: 16px;
		box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
		padding: 24px;
	}

	#addBatch .form_label label {
		font-size: 16px;
		font-weight: 700;
		color: #1f324b;
	}

	#addBatch .form_field input[type="text"] {
		width: 100%;
		min-height: 52px;
		border: 1px solid #c8d8ea;
		border-radius: 12px;
		padding: 11px 14px;
		background: #f6faff;
		font-size: 16px;
		outline: none;
	}

	#addBatch .form_field input[type="text"]:focus {
		border-color: #2563eb;
		background: #ffffff;
		box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
	}

	#addBatch .button {
		border: 0;
		border-radius: 12px;
		padding: 11px 20px;
		background: linear-gradient(135deg, #102a48, #123b66);
		font-weight: 700;
		box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
	}

	#addBatch .button:hover {
		filter: brightness(1.06);
	}
</style>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter"></span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'></div>
					<div id='content_right' class='content_right'>
						<div class="batch-add-hero">
							<h3 class="batch-add-title">Add New Batch</h3>
							<p class="batch-add-subtitle">Create academic batch records for enrollment and reporting.</p>
						</div>
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
							<form id='addBatch' action='add_batch.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for="batch">Batch :</label>
									</div>
									<div class="form_field">
										<input type="text" name="batchName" id="batchName" value="<?php echo htmlspecialchars($_POST['batchName'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type='submit' name='addNewBatch' id="addNewBatch" class="button" value='Add Batch' />
									</div>
								</div>
							</form>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				<?php 
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('../layout/footer.php');
?>
