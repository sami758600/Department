<?php 
    require_once(__DIR__ . '/../../config.php');
    
    require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSection	= TB_SECTION;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);

   if ( isset ( $_POST['addNewSection'] ) ){
   				
		$varArray['class_id']		= $_POST['classId'];
		$varArray['section_code']	= $_POST['sectionCode'];
		$varArray['section_name']	= $_POST['sectionName'];
		
		$addSec		= $fcObj->addSection ( $tbSection, $varArray );
		
		if( $addSec ){
			
			header('Location: sections.php');
			exit;
		}else{
			$msg	= 'Sorry, Please try again';
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

	.section-add-hero {
		border: 1px solid #cfdced;
		border-radius: 18px;
		padding: 18px 22px;
		background:
			linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
			#f8fbff;
		box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
		margin-bottom: 16px;
	}

	.section-add-title {
		margin: 0;
		font-size: 32px;
		font-weight: 800;
		letter-spacing: -0.6px;
		color: #0f172a;
	}

	.section-add-subtitle {
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

	#addSection .form_label label {
		font-size: 16px;
		font-weight: 700;
		color: #1f324b;
	}

	#addSection .form_field select,
	#addSection .form_field input[type="text"] {
		width: 100%;
		min-height: 52px;
		border: 1px solid #c8d8ea;
		border-radius: 12px;
		padding: 11px 14px;
		background: #f6faff;
		font-size: 16px;
		outline: none;
	}

	#addSection .form_field select:focus,
	#addSection .form_field input[type="text"]:focus {
		border-color: #2563eb;
		background: #ffffff;
		box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
	}

	#addSection .button {
		border: 0;
		border-radius: 12px;
		padding: 11px 20px;
		background: linear-gradient(135deg, #102a48, #123b66);
		font-weight: 700;
		box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
	}

	#addSection .button:hover {
		filter: brightness(1.06);
	}
</style>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter"></span>
						<p></p>
					</div>

					<div id='content_left' class='content_left'></div>
                    
					<div id='content_right' class='content_right'>
						<div class="section-add-hero">
							<h3 class="section-add-title">Add New Section</h3>
							<p class="section-add-subtitle">Create section records and map them to classes.</p>
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
							<form id='addSection' action='add_section.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
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
														<option value="<?php echo (int)$classes[$i]['id']; ?>" <?php if (isset($_POST['classId']) && (string)$_POST['classId'] === (string)$classes[$i]['id']) echo 'selected'; ?>>
															<?php echo htmlspecialchars((string)$classes[$i]['class_name'], ENT_QUOTES, 'UTF-8'); ?>
														</option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="sectioncode">Section Code:</label>
									</div>
									<div class="form_field">
										<input type="text" name="sectionCode" id="sectionCode" value="<?php echo htmlspecialchars($_POST['sectionCode'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="sectionname">Section Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="sectionName" id="sectionName" value="<?php echo htmlspecialchars($_POST['sectionName'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type='submit' name='addNewSection' id="addNewSection" class="button" value='Add Section' />
									</div>
								</div>
							</form>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				                <div class="mt-3">
                    <a href="../settings/department_option.php?option=sections" class="btn btn-outline-secondary">Back</a>
                </div><?php 
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('../layout/footer.php');
?>
