<?php 
	include_once('header.php');
	
   require_once("libraries/functions.class.php") ;

   $fcObj			= new DataFunctions();
	
	$eventId		= $_REQUEST['event'];
	
	$tbEvents		= TB_EVENTS;
	$tbEventRes		= TB_EVENT_RESULT;
	
	$eventResCandDet = $fcObj->getEventResult( $tbEventRes , $eventId );
	
	$eventDetails	 = $fcObj->getEventDetails( $tbEvents , $eventId );	
	
	$noOfSLCand		 = sizeof( $eventResCandDet );
?>
 <div class="box1">
        <div class="wrapper">
          <article class="col1">
				<div id="index_cont">
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
							include_once('leftnav.php');
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
								<div class="eventCandName">
									Candidate Name
								</div>
								<div class="eventCandName">
									Admission Id
								</div>
								<div class="eventCandClass">
									Award
								</div>
								<br class="clearfix" />
							</div>
							
							<?php
							if( $noOfSLCand > 0 ){
								for( $i = 0 ; $i < $noOfSLCand ; $i++ ){
							?>
								<div class="eventDet">
									<div class="eventCandName">
										<?php
											echo  $eventResCandDet[$i]['firstname'].' '.$eventResCandDet[$i]['lastname'];
										?>
									</div>
									<div class="eventCandName">
										<?php
											echo  $eventResCandDet[$i]['admission_id'];
										?>
									</div>
									<div class="eventCandClass">
										<?php
											echo  $eventResCandDet[$i]['award'];
										?>
									</div>
								</div>
								<br class="clearfix" />
							<?php
								}
							}else{
								
							?>
								<div class="eventDet">
									Results Are Not Announced Yet, Please Wait...
								</div>
								<br class="clearfix" />
							<?
							}
							?>
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
