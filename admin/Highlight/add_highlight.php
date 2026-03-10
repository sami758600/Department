
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
			
			header('Location: highlights.php');
			exit;
		}else{
			$msg	= 'Sorry, Please try again';
		}
   }

	include_once('../layout/main_header.php');
	include_once('../layout/core_forms_style.php');

?>
<style type="text/css">
	#content_left {
		display: none;
	}

	#content.single-panel-layout {
		grid-template-columns: minmax(320px, 840px);
		justify-content: center;
		gap: 0;
	}

	#content.single-panel-layout .post {
		display: none;
	}

	#content.single-panel-layout #content_right {
		grid-column: 1;
		width: 100%;
	}

	.highlight-add-hero {
		width: 100%;
		max-width: 840px;
		border: 1px solid #cfdced;
		border-radius: 18px;
		padding: 18px 22px;
		background:
			linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
			#f8fbff;
		box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
		margin-bottom: 16px;
	}

	.highlight-add-title {
		margin: 0;
		font-size: 32px;
		font-weight: 800;
		letter-spacing: -0.6px;
		color: #0f172a;
	}

	.highlight-add-subtitle {
		margin: 8px 0 0;
		font-size: 15px;
		color: #556a84;
	}

	#content.single-panel-layout #content_right .comteeMem {
		width: 100%;
		max-width: 840px;
		border: 1px solid #d7dde6;
		border-radius: 16px;
		box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
		padding: 24px;
	}

	#addHighLight.core-form .form_row {
		grid-template-columns: 1fr;
		gap: 8px;
	}

	#addHighLight.core-form .form_label {
		min-height: 0;
		display: block;
		margin: 0;
	}

	#addHighLight.core-form .form_label label {
		font-size: 16px;
		font-weight: 700;
		color: #1f324b;
	}

	#addHighLight.core-form .form_field select,
	#addHighLight.core-form .form_field textarea {
		width: 100%;
		border: 1px solid #c8d8ea;
		border-radius: 12px;
		padding: 11px 14px;
		background: #f6faff;
		font-size: 16px;
		outline: none;
	}

	#addHighLight.core-form .form_field select {
		min-height: 52px;
	}

	#addHighLight.core-form .form_field textarea {
		min-height: 150px;
		resize: vertical;
	}

	#addHighLight.core-form .form_field select:focus,
	#addHighLight.core-form .form_field textarea:focus {
		border-color: #2563eb;
		background: #ffffff;
		box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
	}

	#addHighLight.core-form .form_row.form_actions .form_label {
		display: none;
	}

	#addHighLight.core-form .form_row.form_actions .button {
		border: 0;
		border-radius: 12px;
		padding: 11px 22px;
		background: linear-gradient(135deg, #102a48, #123b66);
		font-size: 18px;
		font-weight: 700;
		box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
	}

	#addHighLight.core-form .form_row.form_actions .button:hover {
		filter: brightness(1.06);
	}
</style>
			<div id="page">
				<div id="content" class="single-panel-layout">
					<div class="post">
						<span class="alignCenter">
							<h4>AIML Department </h4>
						</span>
						<p>
							
						</p>
					</div>
					<!-- <div id='content_left' class='content_left'>
						<?php 
							include_once('../layout/other_leftnav.php');
						?>						
					</div> -->
					<div id='content_right' class='content_right'>
						<div class="highlight-add-hero">
							<h3 class="highlight-add-title">Add New Highlight</h3>
							<p class="highlight-add-subtitle">Create and publish department highlight messages.</p>
						</div>
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
							<form id='addHighLight' class="core-form" action='add_highlight.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
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
								<div class="form_row form_actions">
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
				                <div class="mt-3">
                    <a href="../settings/department_option.php?option=highlights" class="btn btn-outline-secondary">Back</a>
                </div><?php 
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
