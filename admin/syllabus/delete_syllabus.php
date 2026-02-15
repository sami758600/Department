<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSyllabus	= TB_SYLLABUS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   if( isset ( $_GET['syllabus'] ) ){
   		
		$sylId		= $_GET['syllabus'];
		
		$syllabusDet	= $fcObj->getSyllabusById($tbSyllabus,$sylId);
   		$syllabus		= $fcObj->deleteSyllabus($tbSyllabus,$sylId);
	   
	   if( $syllabus ){
	   		
			$sylName	= $syllabusDet[0]['syllabus_name'];
			
			unlink("../uploads/syllabus/".$sylName);
			
			header('Location: syllabus.php');
			return false;
			
	   }else{
	   		
			header('Location: syllabus.php');
			return false;
	   }
   }
   
?>
