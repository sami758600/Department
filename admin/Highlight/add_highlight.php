
<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
 

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();

   
   $tbHighLights		= TB_HIGHLIGHTS;

   if ( isset ( $_POST['addNewHighLight'] ) ){
   				
		$varArray['typeId']		= $_POST['typeId'];

		$varArray['highLight']	= $_POST['highLightName'];
			
		$addHightLight	= $fcObj->addHighLight ( $tbHighLights, $varArray );
		
		if( $addHightLight ){
			
			header('Location: main_home.php');
			return false;
		}else{
			$msg	= 'Sorry, Please try again';
		}
   }

	include_once('../layout/main_header.php');
	include_once('../layout/core_forms_style.php');

?>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>AIML Department </h4>
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
						<?php 
							include_once('../layout/other_leftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<div class="comteeMem">
							<?php
								if( isset ( $msg ) ){
							?>
								<div class="comteeMemRow">
									<div class="usersDetHeader">
										<?php echo $msg;?>
									</div>
								</div>
							<?php
								}
							?>
							<form id='addHighLight' action='add_highlight.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for='type' >Type:</label>
									</div>
									<div class="form_field">
										<select name="typeId" id="typeId" class="typeId">
											<option value="">SELECT</option>
											<option value="<?php echo AIML;?>"><?php echo 'AIML';?></option>
											<option value="<?php echo DEPARTMENT;?>"><?php echo ' DEPARTMENT';?></option>
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='highLight' >High Light :</label>
									</div>
									<div class="form_field" id="highLight">
										<textarea name="highLightName" id="highLightName" class="highLightName" ></textarea>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type='submit' name='addNewHighLight' id="addNewHighLight" class="button" value='Add High Light' />
									</div>
								</div>
							</form>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				<?php 
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('../layout/footer.php');
?>

<script type="text/javascript">
	$('.document').ready(function(){
		
	});
</script>
