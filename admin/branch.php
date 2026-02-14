<?php 
	
	include_once('header.php');

   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();

   $tbStream	= TB_STREAM;

   $branches	= $fcObj->getStreams( $tbStream );
 
   $branchesCnt	= sizeof($branches);
   
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
							<div class="committeeTitle">
								<div class='eventCandName'>
									Branch Name
								</div>
								
							</div>
							<?php
								
								for($j=0; $j< $branchesCnt; $j++){
									
								?>
									<div class="usersDetHeader">
										<div class='eventCandName'>
										<?php 
											echo $branches[$j]['stream_code'];
										?>
										</div>
										<div  class="eventCandName">
											<a href="edit_branch.php?branch=<?php echo $branches[$j]['id'];?>" >
												<input type="button" class="button" value="Edit" />
											</a>
											<a href="delete_branch.php?branch=<?php echo $branches[$j]['id'];?>" >
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
							<a href="add_branch.php" >
								<input type="button" class="button" value="Add Branch" />
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