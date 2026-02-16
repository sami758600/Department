<?php  
	 
	require_once(__DIR__ . '/../../../config.php');

    include_once(INCLUDES_PATH . '/header.php');
    require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();
   
   $tbStaffCateg = TB_STAFF_CATEGORY;
   $tbStaff		 = TB_STAFF;
   
   $staffCateg		= $fcObj->getStaffCategories($tbStaffCateg);
   $categoryCnt		= sizeof($staffCateg);
   
   for($i=0; $i<$categoryCnt;$i++){
  		
		$categoryId	= $staffCateg[$i]['id'];
		
		$staffDetails[$i]	= $fcObj->getStaffDetails($tbStaff,$categoryId);
	}
	
?>
<div class="box1">
        <div class="wrapper">
          <article class="col1">
				<div id="index_cont">
					<div class="post">
						<span class="alignCenter">
							<h4>IT Department </h4>
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
								
								for($j=0; $j< $categoryCnt; $j++){
								
							?>
									<div class="comteeMemRow">
										<div class="committeeTitle">
										<?php 
											echo $staffCateg[$j]['category_name'];
										?>
										</div>
									</div>
									<div class="comteeMemRow">
										<?php
											$catStafCnt	= sizeof($staffDetails[$j]);
											
											for($k=0;$k<$catStafCnt;$k++){
												
												$image	= '';
												$name	= '';
												
												$image	= $staffDetails[$j][$k]['image'];
												$name	= $staffDetails[$j][$k]['first_name'];
										?>
											<div class="comteeMemDetails">
												<div>
													<a href="view_staff.php?staff=<?php echo $staffDetails[$j][$k]['id'];?>">
														<img src="images/staff/<?php echo $image;?>" width='100px' height='100px' />
													</a>
												</div>
												<div class="comiteMemDesig"><?php echo $name;?></div>
												<div class="comiteMemQualif"><?php echo str_replace('\,',',',$staffDetails[$j][$k]['qualification']);?></div>
												<div class="comiteMemDesig"><?php echo $staffDetails[$j][$k]['designation'];?></div>
											</div>
										<?php
											}
										?>
									</div>
									<br class="clearfix" />
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

