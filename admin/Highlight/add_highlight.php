<?php 
	
   require_once("../libraries/functions.class.php") ;

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

	include_once('header.php');

?>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>MBA Department </h4>
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
												
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
											<option value="<?php echo MBA;?>"><?php echo 'MBA';?></option>
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
					include_once('sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('footer.php');
?>

<script type="text/javascript">
	$('.document').ready(function(){
		
	});
</script>