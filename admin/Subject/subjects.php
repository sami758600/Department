<?php 
	
	include_once('header.php');

   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSubject	= TB_SUBJECTS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   for($i=0; $i<$classesCnt;$i++){
  		
		$classId		= $classes[$i]['id'];
		
		$subjects[$i]	= $fcObj->getSubjectsForClass($tbSubject,$classId);
	}
	
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
									Subject
								</div>
								
							</div>
							<?php
								
								for($j=0; $j< $classesCnt; $j++){
									
									if( !empty( $subjects[$j] ) ){
							?>
									<div class="subjHeader">
										<div class='subjName'>
										<?php 
											echo $classes[$j]['class_name'];
										?>
										</div>
										<div class='subjMaterials'>
											<?php 
												$subjectsCnt	= sizeof($subjects[$j]);
												
												for( $k=0;$k<$subjectsCnt;$k++){
													?>
														<div class="eventCandName">
															<?php
																echo $subjects[$j][$k]['sub_code'];
															?>
														</div>
														<div  class="eventCandName">
															<a href="edit_subjects.php?subject=<?php echo $subjects[$j][$k]['id'];?>" >
																<input type="button" class="button" value="Edit" />
															</a>
															<a href="delete_subjects.php?subject=<?php echo $subjects[$j][$k]['id'];?>" >
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
							<a href="add_subject.php" >
								<input type="button" class="button" value="Add Subject" />
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