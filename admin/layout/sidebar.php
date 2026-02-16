	<?php
	$tbHighLights		= TB_HIGHLIGHTS;
	
	$HighLights		= $fcObj->getHighLights( $tbHighLights, anu );
	$HighCnt		= count( $HighLights );
	
	$DepHighLights	= $fcObj->getHighLights( $tbHighLights, DEPARTMENT );
	$DeptHighCnt		= count( $DepHighLights );
	
?>				<div class="sidebar">
					<div class="post">
						<h3 class="sideHeader">MBA</h3>
						<marquee behavior="scroll" direction="up" scrollamount="1" onMouseOver="this.stop();" onMouseOut="this.start();" height="140">
							<ul>
								<?php
									for ( $i=0; $i<$HighCnt; $i++){
									?>
										<li <?php if( $i == 0 ){?> class="first" <?php }?>>
											>> <?php 
												echo $HighLights[$i]['high_light'];
												if( isset( $_SESSION['adminId'] ) ){
											?>
													<a href="delete_highLight.php?highlight=<?php echo $HighLights[$i]['id'];?>" >
														<input type="button" class="button" id="delete" value="Delete"/>
													</a>
											<?php
												}
											?>
										</li>
									<?php
									}
								?>
								
							</ul>
						</marquee>
						<?php
							if( isset( $_SESSION['adminId'] ) ){
						?>
						<div  class="addHighLight">
							<a href="add_highlight.php" >
								<input type="button" class="button" value="Add High Light" />
							</a>
						</div>
						<?php
							}
						?>
					</div>
				</div>
				<div class="sidebar">
					<div class="post">
						<h3 class="sideHeader">Department</h3>
						<marquee behavior="scroll" direction="up" scrollamount="1" onMouseOver="this.stop();" onMouseOut="this.start();" height="140">
							<ul>
								<?php
									for ( $i=0; $i<$DeptHighCnt; $i++){
									?>
										<li <?php if( $i == 0 ){?> class="first" <?php }?>>
											>> <?php 
												echo $DepHighLights[$i]['high_light'];
												if( isset( $_SESSION['adminId'] ) ){
											?>
													<a href="delete_highLight.php?highlight=<?php echo $DepHighLights[$i]['id'];?>" >
														<input type="button" class="button" id="delete" value="Delete"/>
													</a>
											<?php
												}
											?>
										</li>
									<?php
									}
								?>
								
							</ul>
						</marquee>
					</div>
				</div>

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