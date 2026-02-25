<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
      
   $tbPrevPapers = TB_PREV_PAPERS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   if( isset ( $_GET['paper'] ) ){
   		
		$paperId		= $_GET['paper'];
		
   		$paperDet		= $fcObj->getPaperById($tbPrevPapers,$paperId);
   }
   
   if ( isset ( $_POST['editPaper'] ) ){
   				
		$varArray['class_id']		= $_POST['classId'];
		$varArray['subj_id']		= $_POST['subjId'];
		$varArray['paper_name']		= $_POST['paperName'];
		$varArray['paper_id']		= $_POST['paperId'];
		
		if( isset( $_FILES['paperFile'] ) ){
			$fileName	= $_FILES['paperFile']['name'];
			
			if ((move_uploaded_file($_FILES['paperFile']['tmp_name'], "../uploads/previous_papers/".$fileName))){
				
				unlink("../uploads/previous_papers/".$_POST['prePaperFile']);					
				$fileName 	= $fileName;
			}else{
			
				$fileName 	= $_POST['prePaperFile'];
			}
		}else{
			$fileName 	= $_POST['prePaperFile'];
		}
		
		$varArray['paper_file_name']	= $fileName;

		$editPaper	= $fcObj->editPaper ( $tbPrevPapers, $varArray );
		
		if( $editPaper ){
			
			header('Location: previouspapers.php');
			return false;
		}else{
			$msg	= 'Sorry, Please try again';
		}
	}

	include_once('header.php');

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
							include_once('departleftnav.php');
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
							<form id='editMaterial' action='edit_papers.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for='classes' >Class:</label>
									</div>
									<div class="form_field">
										<select name="classId" id="classId" class="classId">
											<?php
												for($i=0;$i<$classesCnt;$i++){
													if( $classes[$i]['id'] == $paperDet[0]['class_id'] ){
													?>
														<option value="<?php echo $classes[$i]['id']; ?>"><?php echo $classes[$i]['class_name']; ?></option>
													<?php
													}
												}
											?>
											<?php
												for($i=0;$i<$classesCnt;$i++){
													if( $classes[$i]['id'] != $paperDet[0]['class_id'] ){
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
										<label for='subject' >Subject:</label>
									</div>
									<div class="form_field" id="subject">
										<select name="subjId" id="subjId" class="subjId">
											<option value="<?php echo $paperDet[0]['subject_id']; ?>"><?php echo $paperDet[0]['sub_code']; ?></option>
											
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="paper">Paper Name:</label>
									</div>
									<div class="form_field">
										<input type="text" name="paperName" id="paperName" value="<?php echo $paperDet[0]['paper_name']; ?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="material">Paper :</label>
									</div>
									<div class="form_field">
										<input type="file" name="paperFile" id="paperFile" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type="hidden" name="prePaperFile" id="prePaperFile" value="<?php echo $paperDet[0]['paper_file']; ?>"/>
										<input type="hidden" name="paperId" id="paperId" value="<?php echo $paperId; ?>"/>
										<input type='submit' name='editPaper' id="editPaper" class="button" value='Edit Paper' />
									</div>
								</div>
							</form>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				<?php 
					include_once('sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<script type="text/javascript">
	$('.document').ready(function(){
		
		$('#classId').change( function(){

			var classId	= $('#classId').val();
			$('#subject').load('subject.php?classId='+classId);
		});
	});
</script>

<?php 
	include_once('footer.php');
?>

