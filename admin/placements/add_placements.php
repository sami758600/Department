<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();

   $tbPlacements = TB_PLACEMENTS;

   if ( isset ( $_POST['addNewPlacement'] ) ){
   				
		$varArray['typeId']		= $_POST['typeId'];

		if(  $_POST['typeId'] == DOCUMENT ){
			$docTitle	= $_POST['placementTitle'];
			
			$fileName	= $_FILES['placementFile']['name'];
		
			if ((move_uploaded_file($_FILES['placementFile']['tmp_name'], "../uploads/placements/".$fileName))){
									
				$fileName 	= $fileName;
			}else{
			
				$fileName 	= '';
			}
			
			$varArray['placement_desc']	= $docTitle.'$$'.$fileName;
			
		}else if(  $_POST['typeId'] == NON_DOCUMENT ){
			$varArray['placement_desc']	= $_POST['placementName'];
			
		}
		
		$addPlacement	= $fcObj->addPlacement ( $tbPlacements, $varArray );
		
		if( $addPlacement ){
			
			header('Location: placements.php');
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
							<form id='addPlacement' action='add_placements.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for='type' >Type:</label>
									</div>
									<div class="form_field">
										<select name="typeId" id="typeId" class="typeId">
											<option value="">SELECT</option>
											<option value="<?php echo DOCUMENT;?>"><?php echo 'DOCUMENT';?></option>
											<option value="<?php echo NON_DOCUMENT;?>"><?php echo 'NON_DOCUMENT';?></option>
										</select>
									</div>
								</div>
								<div class="form_row" id="doc">
									<div class="form_label">
										<label for='placementTitle' >Placement Title:</label>
									</div>
									<div class="form_field" id="subject">
										<input type="text" name="placementTitle" id="placementTitle" class="placementTitle" />
									</div>
								</div>
								<div class="form_row" id="docFile">
									<div class="form_label">
										<label for="placementFile">Placement File:</label>
									</div>
									<div class="form_field">
										<input type="file" name="placementFile" id="placementFile" />
									</div>
								</div>
								<div class="form_row" id="non_doc">
									<div class="form_label">
										<label for='placementName' >Placement :</label>
									</div>
									<div class="form_field" id="subject">
										<textarea name="placementName" id="placementName" class="placementName" ></textarea>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type='submit' name='addNewPlacement' id="addNewPlacement" class="button" value='Add Placement' />
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
		
		$('#doc').hide();
		$('#docFile').hide();
		$('#non_doc').hide();
		
		$('#typeId').change( function(){

			var typeId	= $('#typeId').val();

			if( typeId	== '<?php echo DOCUMENT; ?>'){
				$('#non_doc').hide();
				$('#doc').show();
				$('#docFile').show();
			}else if( typeId	== '<?php echo NON_DOCUMENT; ?>'){
				$('#doc').hide();
				$('#docFile').hide();
				$('#non_doc').show();
			}else{
				$('#doc').hide();
				$('#docFile').hide();
				$('#non_doc').hide();
			}
		});
	});
</script>