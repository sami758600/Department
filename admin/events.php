<?php 
	include_once('header.php');
	
   require_once("../libraries/functions.class.php") ;

   $fcObj			= new DataFunctions();
	
	$tbEvents		= TB_EVENTS;
	
	
	$tbEventTypes	= TB_EVENT_TYPES;
	
	$eventTypes		= $fcObj->getEventTypes( $tbEventTypes );
?>
		<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
		<link type="text/css" href="../styles/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

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
							include_once('leftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<div id="eventDetails">
							<?php
								if( isset ( $_REQUEST['addNewEvent'] ) ){
	
									$varArray['event_type_id']	= $_REQUEST['eventTypeId'];
									$varArray['event_name']		= $_REQUEST['eventName'];
									$varArray['event_desc']		= $_REQUEST['eventDesc'];
									$varArray['event_address']	= $_REQUEST['eventVenue'];
									$varArray['event_date']		= $_REQUEST['eventDate'];
									$varArray['reg_frm_date']	= $_REQUEST['eventRegDate1'];
									$varArray['reg_to_date']	= $_REQUEST['eventRegDate2'];
									
									if( isset ( $_REQUEST['isReg'] ) ){
										$varArray['is_registration']	= 1;
									}else{
										$varArray['is_registration']	= 0;
									}
									
									$addEvent		= $fcObj->addNewEvent ( $tbEvents, $varArray );
									?>
									<div class="comteeMemRow">
										<div class="usersDetHeader">
									<?php
										if ( $addEvent ){
											
											echo 'Event Added Successfully';
										}else{
										
											echo 'Sorry, Please Try Again';
										}
									?>
										</div>
									</div>
									<?php
								}
								
							?>
							<form id='addEvent' action='events.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for='eventType' >Event Type:</label>
									</div>
									<div class="form_field">
										<select name="eventTypeId" id="eventTypeId" class="eventTypeId">
											<option value="">SELECT</option>
											<?php
												$eventTypeCnt	= sizeof( $eventTypes );
												
												for( $i=0; $i< $eventTypeCnt ; $i++){
											?>
													<option value="<?php echo $eventTypes[$i]['id']; ?>"><?php echo $eventTypes[$i]['event_type']?></option>
											<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='eventname' >Event Name:</label>
									</div>
									<div class="form_field">
										<input type="text" name="eventName" id="eventName" class="eventName" value="" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='eventDesc' >Event Description:</label>
									</div>
									<div class="form_field" id="section"> 
										<textarea rows="5" cols="17" name="eventDesc" id="eventDesc" class="eventDesc"></textarea>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='eventVenue' >Event Venue:</label>
									</div>
									<div class="form_field">
										<textarea rows="5" cols="17" name="eventVenue" id="eventVenue" class="eventVenue"></textarea>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='eventVenue' >Event Date:</label>
									</div>
									<div class="form_field"> 
										<input type="text" name="eventDate" class="datepicker" id="eventDate" value=""/>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='eventVenue' >Registration Start Date:</label>
									</div>
									<div class="form_field"> 
										<input type="text" name="eventRegDate1" class="datepicker" id="eventRegDate1" value=""/>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='eventVenue' >Registration End Date:</label>
									</div>
									<div class="form_field"> 
										<input type="text" name="eventRegDate2" class="datepicker" id="eventRegDate2" value=""/>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<input type="checkbox" name="isReg" id="isReg" class="isReg" />
									</div>
									<div class="form_field"> 
										Is Registration Allowed
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type='submit' name='addNewEvent' class="button" value='Add Event' />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<a href="view_events.php" ><input type='button' name='' class="button" value='View Events' /></a>
									</div>
								</div>
								
							</form>
							
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
		 $( ".datepicker" ).datepicker({
			 showOn: "button",
			 buttonImage: "../images/calendar.gif",
			 dateFormat: 'yy-mm-dd',
			 buttonImageOnly: true,
			 altField: '#actualDate',
			 //beforeShowDay: nationalDays
		 });
	});
</script>

<?php 
	include_once('footer.php');
?>


