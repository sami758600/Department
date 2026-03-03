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
	.change-pass-page .page-hero {
		border: 1px solid #cfdced;
		border-radius: 18px;
		padding: 18px 22px;
		background:
			linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
			#f8fbff;
		box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
		margin-bottom: 16px;
	}

	.change-pass-page .page-title {
		margin: 0;
		font-size: 32px;
		font-weight: 800;
		letter-spacing: -0.6px;
		color: #0f172a;
	}

	.change-pass-page .page-subtitle {
		margin: 8px 0 0;
		font-size: 15px;
		color: #556a84;
	}

	#content .post h4 {
		display: none;
		font-size: 24px;
		font-weight: 800;
		letter-spacing: -0.4px;
	}

	#content_left {
		display: none;
	}

	#content {
		grid-template-columns: minmax(320px, 760px);
		justify-content: center;
		gap: 0;
	}

	#content_right .comteeMem {
		max-width: 760px;
		margin: 0 auto;
		border: 1px solid #d7dde6;
		border-radius: 16px;
		box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
		padding: 24px;
	}

	#content_right .usersDetHeader {
		font-size: 16px;
		border-radius: 12px;
		padding: 12px 14px;
		border: 1px solid #dbe5f3;
		background: #f8fbff;
	}

	#content_right .usersDetHeader a {
		font-weight: 700;
	}

	#content_right form .form_label label {
		font-size: 17px;
		font-weight: 700;
		color: #1e354f;
	}

	#content_right form .form_field input[type="password"] {
		width: 100%;
		min-height: 56px;
		border: 1px solid #c8d8ea;
		border-radius: 12px;
		padding: 12px 14px;
		background: #f6faff;
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
		padding: 11px 20px;
		border-radius: 12px;
		background: linear-gradient(135deg, #102a48, #123b66);
		box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
	}

	#content_right #changeAPassWord.button:hover {
		filter: brightness(1.06);
	}

	.change-pass-tips {
		margin-bottom: 14px;
		padding: 10px 12px;
		border: 1px dashed #bfd3ea;
		border-radius: 12px;
		background: linear-gradient(90deg, #f8fbff, #f4f8fd);
		color: #5d718c;
		font-size: 13px;
	}

	@media (max-width: 768px) {
		.change-pass-page .page-title {
			font-size: 26px;
		}

		#content_right form .form_label label {
			font-size: 17px;
		}

		#content_right form .form_field input[type="password"],
		#content_right #changeAPassWord.button {
			font-size: 16px;
		}
	}
</style>

		<div class="change-pass-page">
			<div class="page-hero">
				<h3 class="page-title">Change Admin Password</h3>
				<p class="page-subtitle">Update your admin password to keep the dashboard secure.</p>
			</div>
		</div>

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
								<div class="change-pass-tips">
									Use at least 8 characters with a mix of letters, numbers, and symbols.
								</div>
								<div class="form_row" >
									<div class="form_label">
										<label for='passWord' >Change Password :</label>
									</div>
									<div class="form_field">
										<input type="password" name="adminPassWord" id="adminPassWord" class="adminPassWord" autocomplete="new-password" />
									</div>
								</div>
								<div class="form_row" >
									<div class="form_label">
										<label for='cpassWord' >Confirm Password :</label>
									</div>
									<div class="form_field">
										<input type="password" name="adminCPassWord" id="adminCPassWord" class="adminCPassWord" autocomplete="new-password" />
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
