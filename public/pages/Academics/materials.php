<?php 
	
	require_once(__DIR__ . '/../../../config.php');

    include_once(INCLUDES_PATH . '/header.php');
    require_once(LIB_PATH . '/functions.class.php');

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
															<div class="materailNames">
																<a href="<?php echo 'uploads/materials/'.$materials[$i][$j][$k]['mater_file']; ?>" target="_blank">
																<?php
																	echo $materials[$i][$j][$k]['material_name'];
																?>
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

