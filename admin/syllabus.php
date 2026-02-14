<?php 
	
	include_once('header.php');

   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSyllabus	= TB_SYLLABUS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   for($i=0; $i<$classesCnt;$i++){
  		
		$classId		= $classes[$i]['id'];
		
		$syllabus[$i]	= $fcObj->getSyllabusForClass($tbSyllabus,$classId);
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
							<div class="committeeTitle">
								<div class='eventCandName'>
									Class Name
								</div>
								<div  class="eventCandName">
									Syllabus
								</div>
								
							</div>
							<?php
								
								for($j=0; $j< $classesCnt; $j++){
									
									if( !empty( $syllabus[$j] ) ){
							?>
									<div class="usersDetHeader">
										<div class='eventCandName'>
										<?php 
											echo $classes[$j]['class_name'];
										?>
										</div>
										<div  class="eventCandName">
											<a href="<?php echo '../uploads/syllabus/'.$syllabus[$j][0]['syllabus_name'];	?>" target="_blank">
												Download Syllabus
											</a>
										</div>
										<div  class="eventCandName">
											<a href="edit_syllabus.php?syllabus=<?php echo $syllabus[$j][0]['id'];?>" >
												<input type="button" class="button" value="Edit" />
											</a>
											<a href="delete_syllabus.php?syllabus=<?php echo $syllabus[$j][0]['id'];?>" >
												<input type="button" class="button" id="delete" value="Delete"/>
											</a>
										</div>
									</div>
									
									<br class="clearfix" />
							<?php 
									}
								} 
							?>
							
						</div>
						<div  class="eventCandName">
							<a href="add_syllabus.php" >
								<input type="button" class="button" value="Add Syllabus" />
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