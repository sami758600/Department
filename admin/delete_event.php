<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
	$tbEvents		= TB_EVENTS;
   
   if( isset ( $_GET['event'] ) ){
   		
		$eventId	= $_GET['event'];
		
   		$event		= $fcObj->deleteEvent($tbEvents,$eventId);
	   
	   if( $event ){
	   			
			header('Location: view_events.php');
			return false;
			
	   }else{
	   		
			header('Location: view_events.php');
			return false;
	   }
   }
   
?>
