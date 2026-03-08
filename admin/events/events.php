<?php require_once(__DIR__ . '/../../config.php');
	include_once('../layout/main_header.php');
	include_once('../layout/core_forms_style.php');
	
   require_once(LIB_PATH . '/functions.class.php');

   $fcObj			= new DataFunctions();
	
	$tbEvents		= TB_EVENTS;
	
	
	$tbEventTypes	= TB_EVENT_TYPES;
	
	$eventTypes		= $fcObj->getEventTypes( $tbEventTypes );
?>
		<style type="text/css">
			#content_left {
				display: none;
			}

			#content {
				grid-template-columns: 1fr;
				gap: 0;
			}

			#page {
				max-width: none;
			}

			#content_right #eventDetails {
				background: #ffffff;
				padding: 24px;
				border: 1px solid #e5e7eb;
				border-radius: 14px;
				box-shadow: 0 10px 24px rgba(15, 23, 42, 0.07);
			}

			#addEvent .form_field textarea {
				width: 100%;
				min-height: 110px;
				border: 1px solid #cbd5e1;
				border-radius: 12px;
				padding: 10px 12px;
				background: #f8fafc;
				font-size: 15px;
				outline: none;
				resize: vertical;
			}

			#addEvent .form_field textarea:focus {
				border-color: #2563eb;
				background: #ffffff;
				box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
			}

			#addEvent .form_field input[type="date"] {
				width: 100%;
				min-height: 48px;
				border: 1px solid #cbd5e1;
				border-radius: 12px;
				padding: 10px 12px;
				background: #f8fafc;
				font-size: 15px;
				outline: none;
			}

			#addEvent .form_field input[type="date"]:focus {
				border-color: #2563eb;
				background: #ffffff;
				box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
			}
		</style>

			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter"></span>
						<p></p>
					</div>
					<div id='content_left' class='content_left'></div>
					<div id='content_right' class='content_right'>
						<div id="eventDetails">
							<?php
								if( isset ( $_POST['addNewEvent'] ) ){
	
									$varArray['event_type_id']	= $_POST['eventTypeId'];
									$varArray['event_name']		= $_POST['eventName'];
									$varArray['event_desc']		= $_POST['eventDesc'];
									$varArray['event_address']	= $_POST['eventVenue'];
									$varArray['event_date']		= $_POST['eventDate'];
									$varArray['reg_frm_date']	= $_POST['eventRegDate1'];
									$varArray['reg_to_date']	= $_POST['eventRegDate2'];
									
									if( isset ( $_POST['isReg'] ) ){
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
										<input type="date" name="eventDate" id="eventDate" value=""/>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='eventVenue' >Registration Start Date:</label>
									</div>
									<div class="form_field"> 
										<input type="date" name="eventRegDate1" id="eventRegDate1" value=""/>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='eventVenue' >Registration End Date:</label>
									</div>
									<div class="form_field"> 
										<input type="date" name="eventRegDate2" id="eventRegDate2" value=""/>
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
				                <div class="mt-3">
                    <a href="../settings/department_option.php?option=events" class="btn btn-outline-secondary">Back</a>
                </div><?php 
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('../layout/footer.php');
?>


