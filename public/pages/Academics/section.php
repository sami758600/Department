<?php
	
   require_once("libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   if(isset($_REQUEST['classId'])){
   		
		$classId	= $_REQUEST['classId'];
		
		if( $classId == '' || $classId == NULL ){
			$sections	= array();
		}else{
			$tbSection	= TB_SECTION;
			
			$sections	= $fcObj->getSections( $tbSection, $classId);
		}
		
		?>
				<select name="sectionId" id="sectionId" class="sectionId">
					<option value="">SELECT</option>
					<?php
						$sectionCnt	= sizeof( $sections );
						
						for( $i=0; $i< $sectionCnt ; $i++){
					?>
							<option value="<?php echo $sections[$i]['id']; ?>"><?php echo $sections[$i]['section_name']?></option>
					<?php
						}
					?>
				</select>
		<?php
   }
?>

