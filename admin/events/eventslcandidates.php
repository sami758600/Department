<?php 
	include_once('main_header.php');
	
   require_once("../libraries/functions.class.php") ;

   $fcObj			= new DataFunctions();
	
	if( isset( $_REQUEST['event'] )){
		$eventId		= $_REQUEST['event'];
	}else{
		$eventId		= 0;
	}
	
	$tbEvents		= TB_EVENTS;
	$tbEventReg		= TB_EVENT_REG;
	
	$eventRegCandDet = $fcObj->getEventRegCand( $tbEventReg , $eventId );
	
	$eventDetails	= $fcObj->getEventDetails( $tbEvents , $eventId );	
	
	$noOfRegCand	= sizeof( $eventRegCandDet );
?>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>AIML Association </h4>
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
							<div class="eventTitle">
								<div class="eventHead">
									Event Title :
								</div>
								<div class="eventDes">
									<?php
										echo  $eventDetails[0]['event_name'];
									?>
								</div>
							</div>
							<br class="clearfix" />
					<!--	<div class="eventHead">
								Event Description :
							</div>
							<div class="eventDes">
								<?php
									echo  $eventDetails[0]['event_desc'];
								?>
							</div>
							<br class="clearfix" />
					-->
							<div class="eventTitle">
								<div class="checkBox">
									
								</div>
								<div class="eventName">
									Candidate Name
								</div>
								<div class="eventName">
									Admission Id
								</div>
								<div class="eventRegisDates">
									Candidate Details
								</div>
								<br class="clearfix" />
							</div>
							<form action="eventregcand.php" method="post" enctype="multipart/form-data">
							<?php
								for( $i = 0 ; $i < $noOfRegCand ; $i++ ){
							?>
								<div class="eventDet">
									<div class="checkBox">
										<input type="checkbox" name="event_<?php echo $eventRegCandDet[$i]['id'];?>" value="<?php echo $eventRegCandDet[$i]['id'];?>" />
									</div>
									<div class="eventName">
										<?php
											echo  $eventRegCandDet[$i]['firstname'].' '.$eventRegCandDet[$i]['lastname'];
										?>
									</div>
									<div class="eventName">
										<?php
											echo  $eventRegCandDet[$i]['admission_id'];
										?>
									</div>
									<div class="eventRegisDates">
										<?php
											echo  $eventRegCandDet[$i]['stream_code'].' '.$eventRegCandDet[$i]['class_name'].' '.$eventRegCandDet[$i]['section_name'];
										?>
									</div>
									
								</div>
								<br class="clearfix" />
							<?php
								}
							?>
								<input type="hidden" name="eventName" value="<?php echo $eventDetails[0]['event_name'];?>" />
								<input type="hidden" name="eventId" value="<?php echo $eventDetails[0]['id'];?>" />
								<input type="submit" class="button" name="approveUser" value="Short List" />
							</form>
							<br class="clearfix" />
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
