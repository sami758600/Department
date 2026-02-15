<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbBatch		= TB_BATCH;

   if( isset ( $_GET['batch'] ) ){
   		
		$batchId	= $_GET['batch'];
		
   		$batchDel	= $fcObj->deleteBatch($tbBatch,$batchId);
	   
	   if( $batchDel ){
	   					
			header('Location: batch.php');
			return false;
			
	   }else{
	   		
			header('Location: batch.php');
			return false;
	   }
   }
   
?>
