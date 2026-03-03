<?php 
	
   require_once(__DIR__ . '/../../config.php');
    
    require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSubject	= TB_SUBJECTS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);

   $classId  = isset($_POST['classId']) ? trim($_POST['classId']) : '';
   $subjCode = isset($_POST['subjCode']) ? trim($_POST['subjCode']) : '';
   $subjName = isset($_POST['subjName']) ? trim($_POST['subjName']) : '';

   if ( isset ( $_POST['addNewSubject'] ) ){
   				
		if ($classId === '' || $subjCode === '' || $subjName === '') {
			$msg = 'Please select a class and fill subject code and subject name.';
		} else {
			$varArray['class_id']	= $classId;
			$varArray['subj_code']	= $subjCode;
			$varArray['subj_name']	= $subjName;
			
			$addSubj	= $fcObj->addSubject ( $tbSubject, $varArray );
			
			if( $addSubj ){
				header('Location: subjects.php');
				return false;
			}else{
				$msg	= 'Sorry, Please try again';
			}
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
					</div>
					<div id='content_right' class='content_right'>
						<div class="core-hero">
							<h1>Add Subject</h1>
							<p>Add a subject with class, code, and name details.</p>
						</div>
						<div class="comteeMem">
							<?php
								if( isset ( $msg ) ){
							?>
								<div class="comteeMemRow form-alert error">
									<div>
										<?php echo $msg;?>
									</div>
								</div>
							<?php
								}
							?>
							<form id='addSubject' action='add_subject.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for='classes' >Class:</label>
									</div>
									<div class="form_field">
										<select name="classId" id="classId" class="classId">
											<option value="">SELECT</option>
											<?php
												for($i=0;$i<$classesCnt;$i++){
													?>
														<option value="<?php echo $classes[$i]['id']; ?>" <?php echo ($classId == $classes[$i]['id']) ? 'selected="selected"' : ''; ?>>
															<?php echo $classes[$i]['class_name']; ?>
														</option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="subjectcode">Subject Code:</label>
									</div>
									<div class="form_field">
										<input type="text" name="subjCode" id="subjCode" value="<?php echo htmlspecialchars($subjCode); ?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="subjectname">Subject Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="subjName" id="subjName" value="<?php echo htmlspecialchars($subjName); ?>" />
									</div>
								</div>
								<div class="form_row form-actions">
									<div class="form_field">
										<input type='submit' name='addNewSubject' id="addNewSubject" class="button" value='Add Subject' />
										<a href="subjects.php" class="btn-secondary">Cancel</a>
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

<style type="text/css">
	#content {
		grid-template-columns: 1fr !important;
	}

	#content_left {
		display: none !important;
	}

	#content_right {
		max-width: 980px;
	}

	.core-hero {
		background: #eaf1fb;
		border: 1px solid #bfd2eb;
		border-radius: 24px;
		padding: 24px 28px;
		margin-bottom: 16px;
	}

	.core-hero h1 {
		margin: 0 0 6px;
		font-size: 52px;
		line-height: 1.05;
		font-weight: 800;
		color: #0f172a;
		letter-spacing: -1px;
	}

	.core-hero p {
		margin: 0;
		font-size: 30px;
		line-height: 1.25;
		color: #476182;
	}

	.form-alert {
		border-radius: 12px;
		padding: 12px 14px;
		font-size: 14px;
		margin-bottom: 14px;
	}

	.form-alert.error {
		border: 1px solid #fecaca;
		background: #fef2f2;
		color: #991b1b;
	}

	.form-actions .form_field {
		display: flex;
		align-items: center;
		gap: 10px;
	}

	.btn-secondary {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		min-height: 48px;
		padding: 12px 22px;
		border-radius: 12px;
		border: 1px solid #64748b;
		background: #64748b;
		color: #ffffff;
		font-size: 16px;
		font-weight: 700;
		text-decoration: none;
		transition: .2s ease;
	}

	.btn-secondary:hover {
		filter: brightness(1.05);
		transform: translateY(-1px);
	}

	@media (max-width: 980px) {
		.core-hero h1 {
			font-size: 34px;
		}

		.core-hero p {
			font-size: 20px;
		}
	}

	@media (max-width: 640px) {
		.core-hero {
			padding: 16px 18px;
			border-radius: 18px;
		}

		.core-hero h1 {
			font-size: 28px;
		}

		.core-hero p {
			font-size: 17px;
		}

		.form-actions .form_field {
			flex-direction: column;
			align-items: stretch;
		}

		.form-actions .button,
		.form-actions .btn-secondary {
			width: 100%;
			text-align: center;
		}
	}
</style>
