<?php 
	require_once(__DIR__ . '/../../../config.php');

    include_once(INCLUDES_PATH . '/header.php');
    require_once(LIB_PATH . '/functions.class.php');

   $fcObj			= new DataFunctions();
	
	$staffId		= $_REQUEST['staff'];
	
   $tbStaff		 	= TB_STAFF;
	
	$staffDetails	= $fcObj->getStaffDetailsById( $tbStaff , $staffId );
	$staff         = !empty($staffDetails) ? $staffDetails[0] : null;
?>
			<div class="box1">
        <div class="wrapper">
          <article class="col1">
				<div id="index_cont">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>IT Department </h4>
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
						<?php 
							include_once('itdepartleftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<?php if ($staff === null) { ?>
							<div class="eventDetails">
								<div class="eventDet">
									Staff details are not available for the selected profile.
								</div>
							</div>
						<?php } else { ?>
						<div class="eventDetails" >
							<div class="eventHead">
								
							</div>
							<div class="eventDes">
								<img src="<?php echo BASE_URL; ?>/public/assets/images/staff/<?php echo rawurlencode($staff['image']); ?>" alt="<?php echo $staff['first_name'].' '.$staff['last_name'];?>" title="<?php echo $staff['first_name'].' '.$staff['last_name'];?>" width="100px" height="100px" />
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Staff Name :
							</div>
							<div class="eventDes">
								<?php
									echo  $staff['first_name'].' '.$staff['last_name'];
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Staff Qualification :
							</div>
							<div class="eventDes">
								<?php
									echo  str_replace('\,',',',$staff['qualification']);
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Staff Designation :
							</div>
							<div class="eventDes">
								<?php
									echo  $staff['designation'];
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Staff E_Mail :
							</div>
							<div class="eventDes">
								<?php
									echo  $staff['e_mail'];
								?>
							</div>
							<br class="clearfix" />
							<?php 
							if( $staff['staff_categ_id'] == TEACHING ){
							?>
								<div class="eventHead">
									Industry Experience :
								</div>
								<div class="eventDes">
									<?php
										echo  $staff['industry_exp'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									Teaching Experience :
								</div>
								<div class="eventDes">
									<?php
										echo  $staff['teach_exp'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									Research :
								</div>
								<div class="eventDes">
									<?php
										echo  $staff['research'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead bold">
									Publications
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									National :
								</div>
								<div class="eventDes">
									<?php
										echo  $staff['publ_national'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									Inter National :
								</div>
								<div class="eventDes">
									<?php
										echo  $staff['publ_international'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead bold">
									Conferences
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									National :
								</div>
								<div class="eventDes">
									<?php
										echo  $staff['conf_national'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									Inter National :
								</div>
								<div class="eventDes">
									<?php
										echo  $staff['conf_international'];
									?>
								</div>
							<?php
							}
							?>
							<br class="clearfix" />
							<div class="eventHead">
								
							</div>
							
						</div>
						<?php } ?>
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
		
<script type="text/javascript" language="javascript">
	
	$(document).ready(function() {
		
	});
</script>

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>

