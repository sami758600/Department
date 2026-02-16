<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbBatch		= TB_BATCH;

   if( isset ( $_GET['batch'] ) ){
   		
		$batchId	= $_GET['batch'];
		
   		$batchDet	= $fcObj->getBatchById($tbBatch,$batchId);
   }
   
   if ( isset ( $_POST['editBatch'] ) ){
   				
		$varArray['batch_id']		= $_POST['batchId'];
			
		$varArray['batch_name']		= $_POST['batchName'];

		$editClass	= $fcObj->editBatch ( $tbBatch, $varArray );
		
		if( $editClass ){
			
			header('Location: batch.php');
			return false;
		}else{
   			
			$classDet	= $fcObj->getBatchById($tbClass,$_POST['batchId']);
			$msg	= 'Sorry, Please try again';
		}
   }

	include_once('main_header.php');

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
							include_once('other_leftnav.php');
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
				<?php 
					include_once('admin/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('admin/footer.php');
?>

