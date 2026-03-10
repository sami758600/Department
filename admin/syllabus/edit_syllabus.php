<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
 

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSyllabus	= TB_SYLLABUS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   if( isset ( $_GET['syllabus'] ) ){
   		
		$sylId		= $_GET['syllabus'];
		
   		$syllabus	= $fcObj->getSyllabusById($tbSyllabus,$sylId);
		if (empty($syllabus)) {
			header('Location: syllabus.php');
			exit;
		}
   }

   if (!isset($syllabus) || empty($syllabus)) {
		header('Location: syllabus.php');
		exit;
   }
   
   if ( isset ( $_POST['editSyllabus'] ) ){
   				
		$varArray['class_id']		= $_POST['classId'];
		
		if( isset( $_FILES['syllabusFile'] ) ){
		
			$fileName	= $_FILES['syllabusFile']['name'];
			$uploadDir   = ROOT_PATH . '/public/uploads/syllabus/';

			if (!is_dir($uploadDir)) {
				@mkdir($uploadDir, 0777, true);
			}
			
			if ((move_uploaded_file($_FILES['syllabusFile']['tmp_name'], $uploadDir . $fileName))){
				
				$prevFile	= $_POST['syllabusName'];
				$prevPath    = $uploadDir . $prevFile;
				if ($prevFile !== '' && file_exists($prevPath)) {
					@unlink($prevPath);
				}
				$fileName 	= $fileName;
			}else{
			
				$fileName 	= $_POST['syllabusName'];
			}
		}else{
			$fileName 	= $_POST['syllabusName'];
		}
		
		$varArray['syllabus_name']	= $fileName;

		$editSyllabus	= $fcObj->editSyllabus ( $tbSyllabus, $varArray );
		
		if( $editSyllabus ){
			
			header('Location: syllabus.php');
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
							<form id='editSyllabus' action='edit_syllabus.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for='classes' >Class:</label>
									</div>
									<div class="form_field">
										<select name="classId" id="classId" class="classId">
											<?php
												for($i=0;$i<$classesCnt;$i++){
													if( $classes[$i]['id'] == $syllabus[0]['class_id'] ){
													?>
														<option value="<?php echo $classes[$i]['id']; ?>"><?php echo $classes[$i]['class_name']; ?></option>
													<?php
													}
												}
											?>
											<?php
												for($i=0;$i<$classesCnt;$i++){
													if( $classes[$i]['id'] != $syllabus[0]['class_id'] ){
													?>
														<option value="<?php echo $classes[$i]['id']; ?>"><?php echo $classes[$i]['class_name']; ?></option>
													<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="syllabus">Syllabus :</label>
									</div>
									<div class="form_field">
										<input type="file" name="syllabusFile" id="syllabusFile" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type="hidden" name="syllabusName" id="syllabusName" value="<?php echo $syllabus[0]['syllabus_name']; ?>"/>
										<input type='submit' name='editSyllabus' class="button" value='Edit Syllabus' />
									</div>
								</div>
							</form>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				                <div class="mt-3">
                    <a href="../settings/department_option.php?option=syllabus" class="btn btn-outline-secondary">Back</a>
                </div><?php 
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('../layout/footer.php');
?>

