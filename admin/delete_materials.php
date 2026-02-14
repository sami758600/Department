<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbMaterial	= TB_MATERAILS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   if( isset ( $_GET['material'] ) ){
   		
		$materialId		= $_GET['material'];
		
		$materialDet	= $fcObj->getMaterialById($tbMaterial,$materialId);
		$matFileName	= $materialDet[0]['mater_file'];
		
   		$material		= $fcObj->deleteMaterial($tbMaterial,$materialId);
	   
	   if( $material ){
			
			unlink("../uploads/materials/".$matFileName);
			header('Location: materials.php');
			return false;
	   }else{
	   		
			header('Location: materials.php');
			return false;
	   }
   }
   
?>
