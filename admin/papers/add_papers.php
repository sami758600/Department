<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbPrevPaper	= TB_PREV_PAPERS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);

   if ( isset ( $_POST['addNewPaper'] ) ){
   				
		$varArray['class_id']		= $_POST['classId'];
		$varArray['subj_id']		= $_POST['subjId'];
		$varArray['paper_name']		= $_POST['paperName'];
		
		$fileName	= $_FILES['paperFile']['name'];
		
		if ((move_uploaded_file($_FILES['paperFile']['tmp_name'], "../uploads/previous_papers/".$fileName))){
								
			$fileName 	= $fileName;
		}else{
		
			$fileName 	= '';
		}
		
		$varArray['paper_file_name']	= $fileName;

		$addPaper	= $fcObj->addPaper ( $tbPrevPaper, $varArray );
		
		if( $addPaper ){
			
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
							<form id='addMaterial' action='add_papers.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
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
										<label for='subject' >Subject:</label>
									</div>
									<div class="form_field" id="subject">
										<select name="subjectId" id="subjectId" class="subjectId">
											<option value="">SELECT</option>
											
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="material">Paper Name:</label>
									</div>
									<div class="form_field">
										<input type="text" name="paperName" id="matepaperNamerialName" />
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
										<input type='submit' name='addNewPaper' id="addNewPaper" class="button" value='Add Paper' />
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

<?php 
	include_once('footer.php');
?>

<script type="text/javascript">
	$('.document').ready(function(){
		
		$('#classId').change( function(){

			var classId	= $('#classId').val();
			$('#subject').load('subject.php?classId='+classId);
		});
	});
</script>