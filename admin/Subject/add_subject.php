<?php 
	
   require_once(__DIR__ . '/../../config.php');
    
    require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSubject	= TB_SUBJECTS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);

   if ( isset ( $_POST['addNewSubject'] ) ){
   				
		$varArray['class_id']	= $_POST['classId'];
		$varArray['subj_code']	= $_POST['subjCode'];
		$varArray['subj_name']	= $_POST['subjName'];
		
		$addSubj	= $fcObj->addSubject ( $tbSubject, $varArray );
		
		if( $addSubj ){
			
			header('Location: subjects.php');
			return false;
		}else{
			$msg	= 'Sorry, Please try again';
		}
   }

	include_once('../layout/main_header.php');

?>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>AIML Department </h4>
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
						<?php 
							include_once('../layout/other_leftnav.php');
						?>						
					</div>
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
														<option value="<?php echo $classes[$i]['id']; ?>"><?php echo $classes[$i]['class_name']; ?></option>
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
										<input type="text" name="subjCode" id="subjCode" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="subjectname">Subject Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="subjName" id="subjName" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type='submit' name='addNewSubject' id="addNewSubject" class="button" value='Add Subject' />
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
