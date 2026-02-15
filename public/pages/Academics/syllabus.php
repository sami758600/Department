<?php 
	
	require_once(__DIR__ . '/../../../config.php');

    include_once(INCLUDES_PATH . '/header.php');
    require_once(LIB_PATH . '/functions.class.php');

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
		 <div class="box1">
        <div class="wrapper">
          <article class="col1">
				<div id="index_cont">
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
								<div  class="eventCandClass">
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
										<div  class="eventCandClass">
											<a href="<?php echo 'uploads/syllabus/'.$syllabus[$j][0]['syllabus_name'];	?>" target="_blank">
												Download Syllabus
											</a>
										</div>
									</div>
									
									<br class="clearfix" />
							<?php 
									}
								} 
							?>
							
						</div>
					</div>
					<br class="clearfix" />
				</div>
					</article>
					<article class="col2 pad_left2">
					<?php 
						include_once('sidebar.php');
					?>
					</article>
</div>
</div>
</section>
<?php include_once(INCLUDES_PATH . '/footer.php'); ?>

