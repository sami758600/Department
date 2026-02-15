<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;

   $classes		= $fcObj->getClasses( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   if( isset ( $_GET['class'] ) ){
   		
		$clsId		= $_GET['class'];
		
   		$classDel	= $fcObj->deleteClass($tbClass,$clsId);
	   
	   if( $classDel ){
	   					
			header('Location: otheroperations.php');
			return false;
			
	   }else{
	   		
			header('Location: otheroperations.php');
			return false;
	   }
   }
   
?>
