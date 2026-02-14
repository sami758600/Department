<?php 
	include_once('header.php');
	
   require_once("libraries/functions.class.php") ;

   $fcObj			= new DataFunctions();
	
	$eventId		= $_REQUEST['event'];
	
	$tbEvents		= TB_EVENTS;
	
	$eventDetails	= $fcObj->getEventDetails( $tbEvents , $eventId );	
?>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>WISE Association </h4>
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
						<?php 
							include_once('leftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<div class="eventDetails" >
							<div class="eventHead">
								Event Title :
							</div>
							<div class="eventDes">
								<?php
									echo  $eventDetails[0]['event_name'];
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Event Description :
							</div>
							<div class="eventDes">
								<?php
									echo  $eventDetails[0]['event_desc'];
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Event Date :
							</div>
							<div class="eventDes">
								<?php
									echo  date("d-m-Y", strtotime($eventDetails[0]['event_date']));
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Venue :
							</div>
							<div class="eventDes">
								<?php
									echo  $eventDetails[0]['event_address'];
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								Registration Dates :
							</div>
							<div class="eventDes">
								<?php
									echo  date("d-m-Y", strtotime($eventDetails[0]['reg_frm_date'])).' to '.date("d-m-Y", strtotime($eventDetails[0]['reg_to_date']));
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
								
							</div>
							<?php
								if(isset($_SESSION['userId'])){ 
							?>
									<div class="eventDes">
										<form action="eventsregister.php" name="currentEventForm" id="currentEventForm" class="currentEventForm" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="event<?php echo $eventDetails[0]['id'];?>" value="<?php echo $eventDetails[0]['id'];?>" checked="checked" />
											<input type="submit" name="currentEventReg" class='button' value="Register" />
										</form>
									</div>
							<?php
								}
							?>
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
		
<script type="text/javascript" language="javascript">
	
	$(document).ready(function() {
		
	});
</script>

<?php 
	include_once('footer.php');
?>
