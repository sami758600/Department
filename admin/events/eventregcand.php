<?php require_once(__DIR__ . '/../../config.php');
	include_once('../layout/main_header.php');
	include_once('../layout/core_forms_style.php');
	include_once('../layout/events_list_style.php');

   require_once(LIB_PATH . '/functions.class.php');

   $fcObj			= new DataFunctions();
   
     
   $tbEvents		= TB_EVENTS;
   $tbEventReg		= TB_EVENT_REG;

  if( isset ( $_REQUEST['approveUser'] ) ){
   
	   array_pop ( $_REQUEST );
	   
	   $eventId			= array_pop ( $_REQUEST );
	   $eventName		= array_pop ( $_REQUEST );
	   
	   $regUsers		= $_REQUEST;
	   
	   $noOfSLUsers		= sizeof( $regUsers );
	   
	   $msg = '';
	   
	   if( $noOfSLUsers == 0 ){
	   		$msg = 'Please Select Atleast One User For Event " '. $eventName.' " To Approve';
	   }
	  
	   for( $i = 0 ; $i < $noOfSLUsers ; $i++ ){
	   		$userId				= array_shift($regUsers);
	   		$approveUser[$i]	= $fcObj->approveUserForEvent( $tbEventReg, $eventId, $userId );
	   }
	   
	   if( !empty( $approveUser ) ){
	   
	   		$msg		= 'Users For Event " '. $eventName.' " Are Short Listed Successfully';
		}
   }
	
   $curEvents		= $fcObj->getCurrentEvents(	$tbEvents, WISE );
   
   $noOfCEvents		= sizeof( $curEvents );
	
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
							include_once('../layout/leftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<div id="currentevents" class="currentevents">
							<div id="eventDetails">
								<?php
									if( isset ( $msg ) ){
								?>
									<div class="comteeMemRow">
										<div class="usersDetHeader">
											<?php echo $msg;?>
										</div>
									</div>
								<?php
									}
								?>
								<div class="eventDetHeader">
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
								
								<?php
									for( $i = 0; $i < $noOfCEvents; $i++){
										
									?>
										<div class="eventDet">
											<div class="sno">
												<?php echo $i+1; ?>
											</div>
											<div class="eventName">
												<a href="eventslcandidates.php?event=<?php echo $curEvents[$i]['id'];?>"><?php echo $curEvents[$i]['event_name']; ?></a>
											</div>
											<div class="eventDate">
												<?php echo $curEvents[$i]['event_date']; ?>
											</div>
											<div class="eventRegisDates">
												<?php echo $curEvents[$i]['reg_frm_date'].' to '.$curEvents[$i]['reg_to_date']; ?>
											</div>
										</div>
									<?php
									}
								?>
							</div>
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

<?php 
	include_once('../layout/footer.php');
?>
