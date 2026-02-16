<?php 
	
	include_once('main_header.php');

   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();

   $tbBatch		= TB_BATCH;

   $batches		= $fcObj->getBatches( $tbBatch );
 
   $batchesCnt	= sizeof($batches);
   
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
							include_once('admin/other_leftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<div class="comteeMem">
							<div class="committeeTitle">
								<div class='eventCandName'>
									Class Name
								</div>
								
							</div>
							<?php
								
								for($j=0; $j< $batchesCnt; $j++){
									
								?>
									<div class="usersDetHeader">
										<div class='eventCandName'>
										<?php 
											echo $batches[$j]['batch'];
										?>
										</div>
										<div  class="eventCandName">
											<a href="edit_batch.php?batch=<?php echo $batches[$j]['id'];?>" >
												<input type="button" class="button" value="Edit" />
											</a>
											<a href="delete_batch.php?batch=<?php echo $batches[$j]['id'];?>" >
												<input type="button" class="button" id="delete" value="Delete"/>
											</a>
										</div>
									</div>
									
									<br class="clearfix" />
							<?php 
								} 
							?>
							
						</div>
						<div  class="eventCandName">
							<a href="add_batch.php" >
								<input type="button" class="button" value="Add Batch" />
							</a>
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