<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbSection	= TB_SECTION;
   
   if( isset ( $_GET['section'] ) ){
   		
		$secId		= $_GET['section'];
		
   		$secDel		= $fcObj->deleteSection($tbSection,$secId);
	   
	   if( $secDel ){
	   					
			header('Location: sections.php');
			return false;
			
	   }else{
	   		
			header('Location: sections.php');
			return false;
	   }
   }
   
?>
