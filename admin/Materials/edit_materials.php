<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
      
   $tbMaterial	= TB_MATERAILS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   if( isset ( $_GET['material'] ) ){
   		
		$materialId		= $_GET['material'];
		
   		$materialDet	= $fcObj->getMaterialById($tbMaterial,$materialId);
   }
   
   if ( isset ( $_POST['editMaterial'] ) ){
   				
		$varArray['class_id']		= $_POST['classId'];
		$varArray['subj_id']		= $_POST['subjId'];
		$varArray['material_name']	= $_POST['materialName'];
		$varArray['material_id']	= $_POST['materialId'];
		
		if( isset( $_FILES['materialFile'] ) ){
			$fileName	= $_FILES['materialFile']['name'];
			
			if ((move_uploaded_file($_FILES['materialFile']['tmp_name'], "../uploads/materials/".$fileName))){
				
				unlink("../uploads/materials/".$_POST['preMaterialFile']);					
				$fileName 	= $fileName;
			}else{
			
				$fileName 	= $_POST['preMaterialFile'];
			}
		}else{
			$fileName 	= $_POST['preMaterialFile'];
		}
		
		$varArray['material_file_name']	= $fileName;

		$editMaterial	= $fcObj->editMaterial ( $tbMaterial, $varArray );
		
		if( $editMaterial ){
			
			header('Location: materials.php');
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
							<h4>MBA Department </h4>
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
							<form id='editMaterial' action='edit_materials.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for='classes' >Class:</label>
									</div>
									<div class="form_field">
										<select name="classId" id="classId" class="classId">
											<?php
												for($i=0;$i<$classesCnt;$i++){
													if( $classes[$i]['id'] == $materialDet[0]['class_id'] ){
													?>
														<option value="<?php echo $classes[$i]['id']; ?>"><?php echo $classes[$i]['class_name']; ?></option>
													<?php
													}
												}
											?>
											<?php
												for($i=0;$i<$classesCnt;$i++){
													if( $classes[$i]['id'] != $materialDet[0]['class_id'] ){
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
											<option value="<?php echo $materialDet[0]['subject_id']; ?>"><?php echo $materialDet[0]['sub_code']; ?></option>
											
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="material">Material Name:</label>
									</div>
									<div class="form_field">
										<input type="text" name="materialName" id="materialName" value="<?php echo $materialDet[0]['material_name']; ?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="material">Material :</label>
									</div>
									<div class="form_field">
										<input type="file" name="materialFile" id="materialFile" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type="hidden" name="preMaterialFile" id="preMaterialFile" value="<?php echo $materialDet[0]['mater_file']; ?>"/>
										<input type="hidden" name="materialId" id="materialId" value="<?php echo $materialId; ?>"/>
										<input type='submit' name='editMaterial' id="editMaterial" class="button" value='Edit Material' />
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

