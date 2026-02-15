<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj		= new DataFunctions();
   
   $tbBatch		= TB_BATCH;

   if ( isset ( $_POST['addNewBatch'] ) ){
   				
		$varArray['batch_name']		= $_POST['batchName'];
		
		$addBatch	= $fcObj->addBatch ( $tbBatch, $varArray );
		
		if( $addBatch ){
			
			header('Location: batch.php');
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
							<form id='addBatch' action='add_batch.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for="batch">Batch :</label>
									</div>
									<div class="form_field">
										<input type="text" name="batchName" id="batchName" />
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
		$('#delete').click(function(){
			var conf	= confirm('Do You Want To Continue To Delete');
			if( conf ){
				
			}else{
				return false;
			}
		});
	});
</script>