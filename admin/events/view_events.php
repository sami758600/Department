<?php 
	include_once('main_header.php');
	
   require_once("../libraries/functions.class.php") ;

   $fcObj			= new DataFunctions();
	
	$tbEvents		= TB_EVENTS;
	
	$pastEvents		= $fcObj->getPastEvents( $tbEvents, anu );
	$noOfPEvents	= sizeof( $pastEvents );
	
	$curEvents		= $fcObj->getCurrentEvents(	$tbEvents, anu );
	$noOfCEvents	= sizeof( $curEvents );

	$futureEvents	= $fcObj->getFutureEvents( $tbEvents, anu );
	$noOfFEvents	= sizeof( $futureEvents );
	
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
						<div class="eventHeader">
							<div class="eventCateg" id="pastEvent">
								<a href="#pastevents" class='pastEvent'>Past Events</a>
							</div>
							<div class="eventCateg" id="currentEvent">
								<a href="#currentevents" class='currentEvent'>Current Events</a>
							</div>
							<div class="eventCateg" id="futureEvent">
								<a href="#futureevents" class='futureEvent'>Future Events</a>
							</div>
						</div>
						<div id="eventDetails">
							<div id="pastevents" class="pastevents">
								<div class="eventDetHeader">
									<div class="checkBox">
										
									</div>
									<div class="sno">
										S NO
									</div>
									<div class="eventName">
										Event Name
									</div>
									<div class="eventDate">
										Event Date
									</div>
									<div class="eventRegisDates">
										Registration Dates
									</div>		
								</div>
								<form action="eventsregister.php" method="POST" enctype="multipart/form-data">
								<?php
									for( $i = 0; $i < $noOfPEvents; $i++){
										
									?>
										<div class="eventDet">
											<div class="checkBox">
											
											</div>
											<div class="sno">
												<?php echo $i+1; ?>
											</div>
											<div class="eventName">
												<a href="eventdetails.php?event=<?php echo $pastEvents[$i]['id'];?>"><?php echo $pastEvents[$i]['event_name']; ?></a>
											</div>
											<div class="eventDate">
												<?php echo date("d-m-Y", strtotime($pastEvents[$i]['event_date'])); ?>
											</div>
											<div class="eventRegisDates">
												<?php echo date("d-m-Y", strtotime($pastEvents[$i]['reg_frm_date'])).' to '.date("d-m-Y", strtotime($pastEvents[$i]['reg_to_date'])); ?>
												<a href="delete_event.php?event=<?php echo $pastEvents[$i]['id'];?>" >
													<input type="button" class="button" id="delete" value="Delete"/>
												</a>
											</div>
										</div>
									<?php
									}
								?>
							</div>
							<div id="currentevents" class="currentevents">
								<div class="eventDetHeader">
									<div class="checkBox">
										
									</div>
									<div class="sno">
										S NO
									</div>
									<div class="eventName">
										Event Name
									</div>
									<div class="eventDate">
										Event Date
									</div>
									<div class="eventRegisDates">
										Registration Dates
									</div>		
								</div>
								<form action="eventsregister.php" name="currentEventForm" id="currentEventForm" class="currentEventForm" method="POST" enctype="multipart/form-data">
								<?php
									for( $i = 0; $i < $noOfCEvents; $i++){
										
									?>
										<div class="eventDet">
											<div class="checkBox">
											<?php
												
												$todayDate	= strtotime( date('Y-m-d') );
												$eventRegD1	= strtotime( $curEvents[$i]['reg_frm_date'] );
												$eventRegD2	= strtotime( $curEvents[$i]['reg_to_date'] );
												
											?>
											</div>
											<div class="sno">
												<?php echo $i+1; ?>
											</div>
											<div class="eventName">
												<a href="eventdetails.php?event=<?php echo $curEvents[$i]['id'];?>"><?php echo $curEvents[$i]['event_name']; ?></a>
											</div>
											<div class="eventDate">
												<?php echo date("d-m-Y", strtotime($curEvents[$i]['event_date'])); ?>
											</div>
											<div class="eventRegisDates">
												<?php echo date("d-m-Y", strtotime($curEvents[$i]['reg_frm_date'])).' to '.date("d-m-Y", strtotime($curEvents[$i]['reg_to_date'])); ?>
												<a href="edit_event.php?event=<?php echo $curEvents[$i]['id'];?>" >
													<input type="button" class="button" id="edit" value="Edit"/>
												</a>
												<a href="delete_event.php?event=<?php echo $curEvents[$i]['id'];?>" >
													<input type="button" class="button" id="delete" value="Delete"/>
												</a>
											</div>
										</div>
									<?php
									}
								?>
									
								</form>
							</div>
							<div id="futureevents" class="futureevents">
								<div class="eventDetHeader">
									<div class="checkBox">
										
									</div>
									<div class="sno">
										S NO
									</div>
									<div class="eventName">
										Event Name
									</div>
									<div class="eventDate">
										Event Date
									</div>
									<div class="eventRegisDates">
										Registration Dates
									</div>		
								</div>
								<form action="eventsregister.php" name="futureEventForm" id="futureEventForm" class="futureEventForm" method="POST" enctype="multipart/form-data">			<?php
									for( $i = 0; $i < $noOfFEvents; $i++){
										
									?>
										<div class="eventDet">
											<div class="checkBox">
											<?php
												
												$todayDate	= strtotime( date('Y-m-d') );
												$eventRegD1	= strtotime( $futureEvents[$i]['reg_frm_date'] );
												$eventRegD2	= strtotime( $futureEvents[$i]['reg_to_date'] );
												
											?>
											</div>
											<div class="sno">
												<?php echo $i+1; ?>
											</div>
											<div class="eventName">
												<a href="eventdetails.php?event=<?php echo $futureEvents[$i]['id'];?>" ><?php echo $futureEvents[$i]['event_name']; ?></a>
											</div>
											<div class="eventDate">
												<?php echo date("d-m-Y", strtotime($futureEvents[$i]['event_date'])); ?>
											</div>
											<div class="eventRegisDates">
												<?php echo date("d-m-Y", strtotime($futureEvents[$i]['reg_frm_date'])).' to '.date("d-m-Y", strtotime($futureEvents[$i]['reg_to_date'])); ?>
												<a href="delete_event.php?event=<?php echo $futureEvents[$i]['id'];?>" >
													<input type="button" class="button" id="delete" value="Delete"/>
												</a>
											</div>
										</div>
									<?php
									}
								?>
									
								</form>
							</div>
							<div class="comteeMemRow">
								<div class="comteeMemDetails">
									<a href="events.php">
										<input type="submit" class="button" name="addEvent" value="Add New Event" />
									</a>
								</div>
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
		
		$('#pastevents').hide();
		$('#futureevents').hide();
		$('#currentEvent').removeClass('eventCateg').addClass('eventCategCurrent');
			
			$('.pastEvent').click( function(){
			$('#pastevents').show();
			$('#currentevents').hide();
			$('#futureevents').hide();
			$('#currentEvent').removeClass('eventCategCurrent').addClass('eventCateg');
			$('#futureEvent').removeClass('eventCategCurrent').addClass('eventCateg');
			$('#pastEvent').removeClass('eventCateg').addClass('eventCategCurrent');
		});
		
		$('.currentEvent').click( function(){
			$('#pastevents').hide();
			$('#currentevents').show();
			$('#futureevents').hide();
			$('#currentEvent').removeClass('eventCateg').addClass('eventCategCurrent');
			$('#futureEvent').removeClass('eventCategCurrent').addClass('eventCateg');
			$('#pastEvent').removeClass('eventCategCurrent').addClass('eventCateg');
		});
		
		$('.futureEvent').click( function(){
			$('#pastevents').hide();
			$('#currentevents').hide();
			$('#futureevents').show();
			$('#currentEvent').removeClass('eventCategCurrent').addClass('eventCateg');
			$('#futureEvent').removeClass('eventCateg').addClass('eventCategCurrent');
			$('#pastEvent').removeClass('eventCategCurrent').addClass('eventCateg');
		});
		
		$('.button').click(function(){
			
		});
	});
</script>

<?php 
	include_once('admin/footer.php');
?>
