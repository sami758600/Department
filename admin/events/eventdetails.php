<?php 
	include_once('main_header.php');
	
   require_once("../libraries/functions.class.php") ;

   $fcObj			= new DataFunctions();
	
	$eventId		= $_REQUEST['event'];
	
	$tbEvents		= TB_EVENTS;
	
	$eventDetails	= $fcObj->getEventDetails( $tbEvents , $eventId );	
?>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>MBA Association </h4>
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
						<?php 
							include_once('admin/leftnav.php');
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
									echo  $eventDetails[0]['event_date'];
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
									echo  $eventDetails[0]['reg_frm_date'].' to '.$eventDetails[0]['reg_to_date'];
								?>
							</div>
							<br class="clearfix" />
							<div class="eventHead">
							</div>
							<div class="eventDes">
								<a href="delete_event.php?event=<?php echo $eventDetails[0]['id'];?>" >
									<input type="button" class="button" id="delete" value="Delete"/>
								</a>
							</div>
							
						</div>						
					</div>
					<br class="clearfix" />
				</div>
				<?php 
					include_once('admin/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>
		
<script type="text/javascript" language="javascript">
	
	$(document).ready(function() {
		
	});
</script>

<?php 
	include_once('admin/footer.php');
?>
