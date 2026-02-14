<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbPrevPapers = TB_PREV_PAPERS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   if( isset ( $_GET['paper'] ) ){
   		
		$paperId		= $_GET['paper'];
		
		$paperDet		= $fcObj->getPaperById($tbPrevPapers,$paperId);
		$paperFileName	= $paperDet[0]['paper_file'];
		
   		$paper		= $fcObj->deletePaper($tbPrevPapers,$paperId);
	   
	   if( $material ){
			
			unlink("../uploads/previous_papers/".$matFileName);
			header('Location: previouspapers.php');
			return false;
	   }else{
	   		
			header('Location: previouspapers.php');
			return false;
	   }
   }
   
?>
