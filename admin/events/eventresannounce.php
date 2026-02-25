<?php 
	include_once('main_header.php');
  
   require_once("../libraries/functions.class.php") ;

   $fcObj			= new DataFunctions();
   
	$tbEventRes		= TB_EVENT_RESULT;

   if ( isset ( $_REQUEST['announceResult'] ) ){
   
   		array_pop($_REQUEST);
		
		$eventId	= array_pop($_REQUEST);
		
		$eventName	= array_pop($_REQUEST);
		
		$eventResults	= $_REQUEST;
		
		$eventResCnt	= sizeof( $eventResults );
		
		$msg	= '';
		
		if( $eventResCnt == 0){
			$msg	= 'Please Select Atleast One user As Winner';
		}
		
		for ( $i = 0 ; $i < $eventResCnt ; $i++ ){
		
			$userDet	= $eventResults[$i];
			
			$eventRes[]	= $fcObj->eventResult( $tbEventRes, $userDet, $eventId);	
		}  
		
		if( !empty( $eventRes ) ){
			$msg	= 'Results Announced Successfully For Event "'.$eventName.'"';
		}
   }
	
   $tbEvents		= TB_EVENTS;
   $tbEventReg		= TB_EVENT_REG;
	
   $curEvents		= $fcObj->getResultedEvents( $tbEvents, anu );
   
   $noOfCEvents		= sizeof( $curEvents );
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
							include_once('wise_leftnav.php');
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
												<a href="eventresult.php?event=<?php echo $curEvents[$i]['id'];?>"><?php echo $curEvents[$i]['event_name']; ?></a>
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
					include_once('admin/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('admin/footer.php');
?>
