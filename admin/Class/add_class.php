<?php require_once(__DIR__ . '/../../config.php');

require_once(LIB_PATH . '/functions.class.php');

	
   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;

   if ( isset ( $_POST['addNewClass'] ) ){
   				
		$varArray['class_code']		= $_POST['classCode'];
		$varArray['class_name']		= $_POST['className'];
		
		$addClass	= $fcObj->addClass ( $tbClass, $varArray );
		
		if( $addClass ){
			
			header('Location: classes.php');
			exit;
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


					<!-- <div id='content_left' class='content_left'>
						<?php 
							include_once('../layout/other_leftnav.php');
						?>						
					</div> -->

                    
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
							<form id='addClass' action='add_class.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for="class">Class Code :</label>
									</div>
									<div class="form_field">
										<input type="text" name="classCode" id="classCode" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="class">Class Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="className" id="className" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type='submit' name='addNewClass' id="addNewClass" class="button" value='Add Class' />
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
		$('#delete').click(function(){
			var conf	= confirm('Do You Want To Continue To Delete');
			if( conf ){
				
			}else{
				return false;
			}
		});
	});
</script>
