<?php 
	
	include_once('../layout/main_header.php');
	
   require_once("../../libraries/functions.class.php") ;

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

				echo 'Pass Word Has Been Changed SuccessFully For Admin ';
				echo '<br/>';
				echo 'Please <a href="index.php">Login </a>to Continue';
			}else{
				echo 'Pass Word Not Changed SuccessFully Please Try Again';
			}
		}else if( ( ($adminPassWord != NULL) || ($adminPassWord != '') ) && ( $adminPassWord != $adminCPassWord ) ){
		
			echo 'Pass Word And Confirm Pass Word Are Not Same Please Try Again';
			
		}else{
			
			echo 'Please Enter Pass Word And Confirm Pass Word';
	
		}
	}
	
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
												
					</div>
					<div id='content_right' class='content_right'>
						<div class="comteeMem">
							
<?php
							if(isset($msg)){
							
								echo $msg;							
							}else{

?>

							<form action="changepassword.php" method="POST" enctype="multipart/form-data">
								<div class="form_row" >
									<div class="form_label">
										<label for='passWord' >Change Pass Word :</label>
									</div>
									<div class="form_field">
										<input type="password" name="adminPassWord" id="adminPassWord" class="adminPassWord" />
									</div>
								</div>
								<div class="form_row" >
									<div class="form_label">
										<label for='cpassWord' >Confirm Pass Word :</label>
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
										<input type="submit" name="changeAPassWord" id="changeAPassWord" class="button" value="Change Admin Pass Word" />
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
			?>git 
			<br class="clearfix" />
		</div>
	</div>
<?php

	include_once('../layout/footer.php');
?>