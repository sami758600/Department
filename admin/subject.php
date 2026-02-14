<?php
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   if(isset($_REQUEST['classId'])){
   		
		$classId	= $_REQUEST['classId'];
		
		$tbSubject	= TB_SUBJECTS;
		
		$subjects	= $fcObj->getSubjectsForClass( $tbSubject, $classId);
		
		?>
			<div class="form_field">
				<select name="subjId" id="subjId" class="subjId">
					<option value="">SELECT</option>
					<?php
						$subjsCnt	= sizeof( $subjects );
						
						for( $i=0; $i< $subjsCnt ; $i++){
					?>
							<option value="<?php echo $subjects[$i]['id']; ?>"><?php echo $subjects[$i]['sub_code']?></option>
					<?php
						}
					?>
				</select>
			</div>
		<?php
   }


?>

<script type="text/javascript" language="javascript">
	
	$(document).ready(function() {
		
		$('#sectionId').change( function(){

			var sectionId	= $('#sectionId').val();
			$('#users').load('section.php?sectionId='+sectionId);
		});
	});
</script>
