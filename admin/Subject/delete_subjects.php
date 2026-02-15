<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbSubject	= TB_SUBJECTS;
   
   if( isset ( $_GET['subject'] ) ){
   		
		$subId		= $_GET['subject'];
		
   		$subDel		= $fcObj->deleteSubject($tbSubject,$subId);
	   
	   if( $subDel ){
	   					
			header('Location: subjects.php');
			return false;
			
	   }else{
	   		
			header('Location: subjects.php');
			return false;
	   }
   }
   
?>
