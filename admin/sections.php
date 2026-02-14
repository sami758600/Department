<?php 
	
	include_once('header.php');

   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSection	= TB_SECTION;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   for($i=0; $i<$classesCnt;$i++){
  		
		$classId		= $classes[$i]['id'];
		
		$sections[$i]	= $fcObj->getSections($tbSection,$classId);
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
							include_once('other_leftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<div class="comteeMem">
							<div class="committeeTitle">
								<div class='subjName'>
									Class Name
								</div>
								<div  class="subjMaterials">
									Section
								</div>
								
							</div>
							<?php
								
								for($j=0; $j< $classesCnt; $j++){
									
									if( !empty( $sections[$j] ) ){
							?>
									<div class="subjHeader">
										<div class='subjName'>
										<?php 
											echo $classes[$j]['class_name'];
										?>
										</div>
										<div class='subjMaterials'>
											<?php 
												$sectionsCnt	= sizeof($sections[$j]);
												
												for( $k=0;$k<$sectionsCnt;$k++){
													?>
														<div class="eventCandName">
															<?php
																echo $sections[$j][$k]['section_code'];
															?>
														</div>
														<div  class="eventCandName">
															<a href="edit_sections.php?section=<?php echo $sections[$j][$k]['id'];?>" >
																<input type="button" class="button" value="Edit" />
															</a>
															<a href="delete_sections.php?section=<?php echo $sections[$j][$k]['id'];?>" >
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
								} 
							?>
							
						</div>
						<div  class="eventCandName">
							<a href="add_section.php" >
								<input type="button" class="button" value="Add Section" />
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