<?php 
	
	include_once('header.php');

   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSubjects	= TB_SUBJECTS;
   
   $tbMaterails	= TB_MATERAILS;

   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   for($i=0; $i<$classesCnt;$i++){
  		
		$classId		= $classes[$i]['id'];
		
		$subjects[$i]	= $fcObj->getSubjectsForClass($tbSubjects,$classId);
		
		$subjCnt		= sizeof( $subjects[$i] );
		
		for( $j=0;$j<$subjCnt;$j++){
		
			$subjId				= $subjects[$i][$j]['id'];
			
			$materials[$i][$j]	= $fcObj->getMaterialsForSubj($tbMaterails,$subjId);
		}
	}

	
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
								
								for($i=0; $i< $classesCnt; $i++){
								
							?>
								<div class="materialDet">
									<div class="classHeader">
										<div class='className'>
										<?php 
											echo $classes[$i]['class_name'];
										?>
										</div>
									</div>
									<?php
								
										$subjCnt	= sizeof( $subjects[$i] );
							
										for($j=0; $j< $subjCnt; $j++){
									?>
										<div  class="subjHeader">
											<div class='subjName'>
												<?php 
													echo $subjects[$i][$j]['sub_code'];
												?>
											</div>
											<div class='subjMaterials'>
												<?php 
													$materCnt	= sizeof($materials[$i][$j]);
													
													for( $k=0;$k<$materCnt;$k++){
														?>
															<div class="eventCandName">
																<a href="<?php echo '../uploads/materials/'.$materials[$i][$j][$k]['mater_file']; ?>" target="_blank">
																<?php
																	echo $materials[$i][$j][$k]['material_name'];
																?>
																</a>
															</div>
															<div  class="eventCandName">
																<a href="edit_materials.php?material=<?php echo $materials[$i][$j][$k]['id'];?>" >
																	<input type="button" class="button" value="Edit" />
																</a>
																<a href="delete_materials.php?material=<?php echo $materials[$i][$j][$k]['id'];?>" >
																	<input type="button" class="button" id="delete" value="Delete"/>
																</a>
															</div>
														<?php
													}
												?>
											</div>
										</div>
										<br class="clearfix" />
									<?php
										}
									?>
									
									<br class="clearfix" />
									</div>
							<?php 
								} 
							?>
							
						</div>
						<div  class="eventCandName">
							<a href="add_materials.php" >
								<input type="button" class="button" value="Add Material" />
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