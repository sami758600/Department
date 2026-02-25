<?php 
	
	include_once('header.php');

   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbPlacements = TB_PLACEMENTS;
   
   $cat_id		 = NON_DOCUMENT;
      
   $placements	 = $fcObj->getPlacements( $tbPlacements, $cat_id );
  
   $placementsCnt	 = sizeof($placements);
   
   $cat_id		 = DOCUMENT;
      
   $placementDocs	 = $fcObj->getPlacements( $tbPlacements, $cat_id );

   $placementDocsCnt = sizeof($placementDocs);

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
							<div class="committeeTitle">
								<div class='sno'>
									S. No
								</div>
								<div  class="achievemnts">
									Placements
								</div>
							</div>
							<?php
								
								for($i=0; $i< $placementsCnt; $i++){
								
							?>
									<div class="usersDetHeader">
										<div class='sno'>
										<?php 
											echo $i+1;
										?>
										</div>
										<div  class="achievementName">
											<?php
												echo $placements[$i]['placement_desc'];
											?>
										</div>
										<div  class="eventCandName">
											<a href="delete_placements.php?placement=<?php echo $placements[$i]['id'];?>" >
												<input type="button" class="button" id="delete" value="Delete"/>
											</a>
										</div>
									</div>
									
									<br class="clearfix" />
							<?php 
								} 
							?>
							</div>
							<div class="comteeMem">
							<?php
								for($i=0; $i< $placementDocsCnt; $i++){
									
									$placementDoc	= $placementDocs[$i]['placement_desc'];

									$placeDocs		= explode('$$',$placementDoc);
							?>
									<div class="committeeTitle">
										<div class='eventCandName'>
											View Full Details
										</div>
										<div  class="eventCandClass">
											<a href="<?php echo '../uploads/placements/'.$placeDocs[1]; ?>" target="_blank">
												<?php 
													echo $placeDocs[0];
												?>
											</a>
										</div>
										<div  class="eventCandName">
											<a href="delete_placements.php?placement=<?php echo $placementDocs[$i]['id'];?>" >
												<input type="button" class="button" id="delete" value="Delete"/>
											</a>
										</div>
									</div>
							<?php
								}
							?>
						</div>
						<div  class="eventCandName">
							<a href="add_placements.php" >
								<input type="button" class="button" value="Add Placements" />
							</a>
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