<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbStream	= TB_STREAM;

   if( isset ( $_GET['branch'] ) ){
   		
		$branchId	= $_GET['branch'];
		
   		$branchDel	= $fcObj->deleteBranch($tbStream,$branchId);
	   
	   if( $branchDel ){
	   					
			header('Location: branch.php');
			return false;
			
	   }else{
	   		
			header('Location: branch.php');
			return false;
	   }
   }
   
?>
