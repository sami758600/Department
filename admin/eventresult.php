<?php 
	include_once('header.php');
	
   require_once("../libraries/functions.class.php") ;

   $fcObj			= new DataFunctions();
	
	$eventId		= $_REQUEST['event'];
	
	$tbEvents		= TB_EVENTS;
	$tbEventRes		= TB_EVENT_RESULT;
	
	$tbEventReg		= TB_EVENT_REG;
	
	$eventSLCandDet	 = $fcObj->getEventSLCand( $tbEventReg , $eventId );
	
	$eventDetails	 = $fcObj->getEventDetails( $tbEvents , $eventId );	
	
	$noOfSLCand		 = sizeof( $eventSLCandDet );
	
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
							include_once('wise_leftnav.php');
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
									Award
								</div>
								<br class="clearfix" />
							</div>
							<form action="eventresannounce.php" method="post" enctype="multipart/form-data">
							<?php
							if( $noOfSLCand > 0 ){
								for( $i = 0 ; $i < $noOfSLCand ; $i++ ){
							?>
								<div class="eventDet">
									<div class="checkBox">
										<input type="checkbox" name="<?php echo $i;?>[user_id]" value="<?php echo $eventSLCandDet[$i]['id'];?>"  />
									</div>
									<div class="eventName">
										<?php
											echo  $eventSLCandDet[$i]['firstname'].' '.$eventSLCandDet[$i]['lastname'];
										?>
									</div>
									<div class="eventName">
										<?php
											echo  $eventSLCandDet[$i]['admission_id'];
										?>
									</div>
									<div class="eventRegisDates">
										<input type="text" name="<?php echo $i;?>[award]" value="" />
									</div>
								</div>
								<br class="clearfix" />
							<?php
								}
							}else{
								
							?>
								<div class="eventDet">
									No Users Are ShortListed
								</div>
								<br class="clearfix" />
							<?
							}
							?>
								<input type="hidden" name="eventName" value="<?php echo $eventDetails[0]['event_name'];?>" />
								<input type="hidden" name="eventId" value="<?php echo $eventDetails[0]['id'];?>" />
								<input type="submit" class="button" name="announceResult" value="Announce Result" />
							</form>
							<br class="clearfix" />
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
