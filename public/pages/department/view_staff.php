<?php 
	include_once('header.php');
	
   require_once("libraries/functions.class.php") ;

   $fcObj			= new DataFunctions();
	
	$staffId		= $_REQUEST['staff'];
	
   $tbStaff		 	= TB_STAFF;
	
	$staffDetails	= $fcObj->getStaffDetailsById( $tbStaff , $staffId );	
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
						<div class="eventDetails" >
							<div class="eventHead">
								
							</div>
							<div class="eventDes">
								<img src="images/staff/<?php echo $staffDetails[0]['image'];?>" alt="<?php echo $staffDetails[0]['first_name'].' '.$staffDetails[0]['last_name'];?>" title="<?php echo $staffDetails[0]['first_name'].' '.$staffDetails[0]['last_name'];?>" width="100px" height="100px" />
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Staff Name :
							</div>
							<div class="eventDes">
								<?php
									echo  $staffDetails[0]['first_name'].' '.$staffDetails[0]['last_name'];
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Staff Qualification :
							</div>
							<div class="eventDes">
								<?php
									echo  str_replace('\,',',',$staffDetails[0]['qualification']);
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Staff Designation :
							</div>
							<div class="eventDes">
								<?php
									echo  $staffDetails[0]['designation'];
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Staff E_Mail :
							</div>
							<div class="eventDes">
								<?php
									echo  $staffDetails[0]['e_mail'];
								?>
							</div>
							<br class="clearfix" />
							<?php 
							if( $staffDetails[0]['staff_categ_id'] == TEACHING ){
							?>
								<div class="eventHead">
									Industry Experience :
								</div>
								<div class="eventDes">
									<?php
										echo  $staffDetails[0]['industry_exp'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									Teaching Experience :
								</div>
								<div class="eventDes">
									<?php
										echo  $staffDetails[0]['teach_exp'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									Research :
								</div>
								<div class="eventDes">
									<?php
										echo  $staffDetails[0]['research'];
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
										echo  $staffDetails[0]['publ_national'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									Inter National :
								</div>
								<div class="eventDes">
									<?php
										echo  $staffDetails[0]['publ_international'];
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
										echo  $staffDetails[0]['conf_national'];
									?>
								</div>
								<br class="clearfix" />
								<div class="eventHead">
									Inter National :
								</div>
								<div class="eventDes">
									<?php
										echo  $staffDetails[0]['conf_international'];
									?>
								</div>
							<?php
							}
							?>
							<br class="clearfix" />
							<div class="eventHead">
								
							</div>
							
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
		
<script type="text/javascript" language="javascript">
	
	$(document).ready(function() {
		
	});
</script>

<?php 
	include_once('footer.php');
?>
