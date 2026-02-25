<?php require_once(__DIR__ . '/../../config.php');

   require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();

   $tbStream	= TB_STREAM;

   $branches	= $fcObj->getStreams( $tbStream );
 
   $branchesCnt	= sizeof($branches);
   
	include_once('../layout/main_header.php');
	include_once('../layout/core_forms_style.php');
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
							include_once('../layout/other_leftnav.php');
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
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('../layout/footer.php');
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
