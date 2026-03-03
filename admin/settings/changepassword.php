<?php require_once(__DIR__ . '/../../config.php'); ?>
<?php 
	
	include_once('../layout/main_header.php');
	include_once('../layout/core_forms_style.php');
	
   require_once(LIB_PATH . '/functions.class.php');

   $fcObj		= new DataFunctions();
   
   $tbAdmin	= ADMIN_TABLE;
   
	if( isset( $_POST['changeAPassWord'] ) ){
	
		$adminPassWord	=  $_POST['adminPassWord'];
		$adminCPassWord	=  $_POST['adminCPassWord'];
		
		if( ( ($adminPassWord != NULL) || ($adminPassWord != '') ) && ( $adminPassWord == $adminCPassWord ) ){
			
			$varArray['admin_name']	= $_SESSION['adminName'];
			$varArray['pass_word']	= sha1($adminPassWord);
			
			$changeAPass	= $fcObj->changeAdminPassWord( $tbAdmin, $varArray );
			
			if( $changeAPass ){
			  
			   unset($_SESSION['adminId']);
			   unset($_SESSION['adminName']);
			   unset($_SESSION['adminFirstName']);
			   unset($_SESSION['adminImage']);

				$msg = 'Password has been changed successfully for Admin. Please <a href="index.php">Login</a> to continue.';
			}else{
				$msg = 'Password not changed successfully. Please try again.';
			}
		}else if( ( ($adminPassWord != NULL) || ($adminPassWord != '') ) && ( $adminPassWord != $adminCPassWord ) ){
		
			$msg = 'Password and Confirm Password are not same. Please try again.';
			
		}else{
			
			$msg = 'Please enter Password and Confirm Password.';
	
		}
	}
	
?>
<style type="text/css">
	/* Medium font sizes for readability on Change Password page */
	#content .post h4 {
		font-size: 24px;
		font-weight: 800;
		letter-spacing: -0.4px;
	}

	#content_left {
		display: none;
	}

	#content {
		grid-template-columns: minmax(320px, 680px);
	}

	#content_right .comteeMem {
		max-width: 680px;
	}

	#content_right .usersDetHeader {
		font-size: 16px;
	}

	#content_right form .form_label label {
		font-size: 18px;
		font-weight: 700;
	}

	#content_right form .form_field input[type="password"] {
		width: 100%;
		min-height: 50px;
		border: 1px solid #cbd5e1;
		border-radius: 12px;
		padding: 10px 12px;
		background: #f8fafc;
		font-size: 16px;
		outline: none;
	}

	#content_right form .form_field input[type="password"]:focus {
		border-color: #2563eb;
		background: #fff;
		box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
	}

	#content_right #changeAPassWord.button {
		font-size: 16px;
		padding: 11px 18px;
	}
</style>

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
												
					</div>
					<div id='content_right' class='content_right'>
						<div class="comteeMem">
							
<?php
							if(isset($msg)){
							
								echo '<div class="comteeMemRow"><div class="usersDetHeader">'.$msg.'</div></div>';							
							}else{

?>

							<form action="changepassword.php" method="POST" enctype="multipart/form-data">
								<div class="form_row" >
									<div class="form_label">
										<label for='passWord' >Change Password :</label>
									</div>
									<div class="form_field">
										<input type="password" name="adminPassWord" id="adminPassWord" class="adminPassWord" />
									</div>
								</div>
								<div class="form_row" >
									<div class="form_label">
										<label for='cpassWord' >Confirm Password :</label>
									</div>
									<div class="form_field">
										<input type="password" name="adminCPassWord" id="adminCPassWord" class="adminCPassWord" />
									</div>
								</div>
								<br class="clearfix" />
								<div class="form_row" >
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type="submit" name="changeAPassWord" id="changeAPassWord" class="button" value="Change Admin Password" />
									</div>
								</div>
							</form>
<?php
							}
?>
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
