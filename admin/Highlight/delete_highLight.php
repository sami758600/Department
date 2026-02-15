<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();

	$tbHighLights		= TB_HIGHLIGHTS;

   if( isset ( $_GET['highlight'] ) ){
   		
		$highLightId		= $_GET['highlight'];
		
   		$highLightDet		= $fcObj->deleteHighLight($tbHighLights,$highLightId);
		
		if( $highLightDet ){
		
			header('Location: main_home.php');
			return false;
		}else{
		
			header('Location: main_home.php');
			return false;
		}
   }
   
?>