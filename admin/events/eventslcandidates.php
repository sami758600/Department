<?php require_once(__DIR__ . '/../../config.php');
	include_once('../layout/main_header.php');
	include_once('../layout/core_forms_style.php');
	include_once('../layout/events_list_style.php');
	
   require_once(LIB_PATH . '/functions.class.php');

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
							include_once('../layout/leftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<div class="eventDetails event-candidate-card" >
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
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>
<style type="text/css">
	.event-candidate-card {
		background: #ffffff;
		border: 1px solid #e5e7eb;
		border-radius: 14px;
		box-shadow: 0 10px 24px rgba(15, 23, 42, 0.07);
		padding: 16px;
	}

	.event-candidate-card .eventTitle,
	.event-candidate-card .eventDet {
		display: grid;
		grid-template-columns: 80px 1fr 180px 1.4fr;
		gap: 10px;
		align-items: center;
		padding: 10px 12px;
		border-bottom: 1px solid #e5e7eb;
	}

	.event-candidate-card .eventTitle {
		background: #eef2ff;
		border: 1px solid #dbe5fb;
		border-radius: 10px;
		color: #1e3a8a;
		font-weight: 700;
		margin-bottom: 8px;
	}

	.event-candidate-card .eventDet:last-of-type {
		border-bottom: 0;
	}

	.event-candidate-card .eventHead {
		font-weight: 700;
		color: #334155;
	}

	.event-candidate-card .button {
		border: 0;
		border-radius: 12px;
		padding: 10px 20px;
		background: linear-gradient(135deg, #0f172a, #1e3a8a);
		color: #fff;
		font-weight: 700;
		box-shadow: 0 8px 16px rgba(30, 58, 138, 0.2);
	}

	@media (max-width: 980px) {
		.event-candidate-card .eventTitle,
		.event-candidate-card .eventDet {
			grid-template-columns: 1fr;
		}
	}
</style>

<?php 
	include_once('../layout/footer.php');
?>
