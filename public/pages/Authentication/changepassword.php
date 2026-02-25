<?php 

 if( session_id() == '' ){
	session_start();
}
	
   require_once("libraries/functions.class.php") ;

   $fcObj		= new DataFunctions();
   
   $tbUser	 = TB_USERS;
   
   $tbBatch		= TB_BATCH;
   $tbStream	= TB_STREAM;
   $tbClass		= TB_CLASS;
   $tbSection	= TB_SECTION;
   
   $batches		= $fcObj->getBatches( $tbBatch );
   $streams		= $fcObj->getStreams( $tbStream );
   $classes		= $fcObj->getClasses( $tbClass );
   
   $userData	= $fcObj->userCheck( $tbUser,$_SESSION['userName']);

   $classData	= $fcObj->getClsBySec( $tbSection, $userData[0]['section'] );

	if( isset( $_POST['update'] ) ){
		
		$msg	= '';

		$uName			= $_POST['uname'];

		$pass			= $_POST['pword'];
		$cPass			= $_POST['confirmpassword'];
		$fName			= $_POST['firstname'];
		$lName			= $_POST['lastname'];
		$gender			= $_POST['gender'];
		$email			= $_POST['email'];
		$address		= $_POST['address'];
		$phone			= $_POST['phone'];
		$class			= $_POST['classId'];
		$batchId		= $_POST['batchId'];
		$streamId		= $_POST['streamId'];
		$section		= $_POST['sectionId'];
		$admissionId	= $_POST['admissionId'];
		$fileName 		= 'user_'.$admissionId.'.png';
		
		if ((move_uploaded_file($_FILES['usrImage']['tmp_name'], "images/users/".$fileName))){
		
			$fileName 	= $fileName;
		}

		$fileName 	= $fileName;
		
		if( $pass != $cPass){
			$msg	= 'Pass Word And Confirm Pass Word Are Not Same Please Try Again';
		}else if( ($pass == $cPass) ){
			
			if( $pass == $userData[0]['password'] ){
				$varArray['password']		= $pass;
			}else{		
				$varArray['password']		= sha1($pass);
			}
			$varArray['mail_id']		= $email;
			$varArray['firstname']		= $fName;
			$varArray['lastname']		= $lName;
			$varArray['gender']			= $gender;
			$varArray['address']		= $address;
			$varArray['mobile_no']		= $phone;
			$varArray['batch_id']		= $batchId;
			$varArray['stream_id']		= $streamId;
			$varArray['section']		= $section;
			$varArray['admission_id']	= $admissionId;
			$varArray['image']			= $fileName;
			
			$changeAPass	= $fcObj->changeUserProfile( $tbUser, $varArray , $uName);
		
			if( $changeAPass ){
			  
				$msg	= 'You Profile Has Been Updated SuccessFully ';
				$msg	.= '<br/>';
			}else{
				$msg	= 'Pass Word Not Changed SuccessFully Please Try Again';
			}
		
		}else{
			
			$msg	= 'Please Enter Pass Word And Confirm Pass Word';
	
		}
	}
	include_once('header.php');

?>
<div class="box1">
        <div class="wrapper">
          <article class="col1">
				<div id="index_cont">
					<div class="post">
						<span class="alignCenter">
							<h4> </h4>
						</span>
						<p>
							
						</p>
					</div>
					
					<div id='content_right' class='content_right'>
						<div class="comteeMem">
							
<?php
							if(isset($msg)){
							
								echo $msg;							
							}else{
?>

							<div class="alignCenter">
								<h3>Update Profile</h3>
							</div>
							<form id="Register" name="register"  action="changepassword.php" method="post" class="AdvancedForm" enctype="multipart/form-data">
								<div class="formData">
									<div class="formRow">  
										<span class="formText"><label for="uname">User Name :</label></span>
										<span class="formField"><input type="text" name="uname" id="uname" value="<?php echo $userData[0]['username'];?>" readonly="readonly" /></span>
									</div>
									<div class="formRow">         
										<span class="formText"><label for="pword">Password :</label></span>
										<span class="formField"><input type="password" name="pword" id="pword" value="<?php echo $userData[0]['password'];?>"/></span>
									</div>
									<div class="formRow">
										<span class="formText"><label for="confirmpassword">Retype Password :</label></span>
										<span class="formField"><input type="password" name="confirmpassword" id="confirmpassword" value="<?php echo $userData[0]['password'];?>"/></span>
									</div>
									<div class="formRow">                                                            
										<span class="formText"><label for="firstname">First Name :</label></span>
										<span class="formField"><input type="text" name="firstname" id="firstname" value="<?php echo $userData[0]['firstname'];?>"/></span>
									</div>
									<div class="formRow">                                                            
										<span class="formText"><label for="lastname">Last Name :</label></span>
										<span class="formField"><input type="text" name="lastname" id="lastname" value="<?php echo $userData[0]['lastname'];?>"/></span>
									</div>
									<div class="formRow">                                                                           
										<span class="formText"><label for="gender">Gender :</label></span>
										<span class="formField">
										  <input name="gender" id="gender" value="male" type="radio" <?if($userData[0]['gender'] == 'male'){?> checked="checked" <? }?> > Male
										  <input name="gender" id="gender" value="female" type="radio" <?if($userData[0]['gender'] == 'female'){?> checked="checked" <? }?>> Female
										</span>
									</div>
									<div class="formRow">
										<span class="formText"><label for="email">Enter Email :</label></span>
										<span class="formField"><input type="text" name="email" id="email" value="<?php echo $userData[0]['mail_id'];?>"/></span>
									</div>
									<div class="formRow">
										<span class="formText"><label for="address">Address :</label></span>
										<span class="formField"><input type="text" name="address" id="address" value="<?php echo $userData[0]['address'];?>" /></span>
									</div>
									<div class="formRow">
										<span class="formText"><label for="phone">Phone :</label></span>
										<span class="formField"><input type="text" name="phone" id="phone" value="<?php echo $userData[0]['mobile_no'];?>"/></span>
									</div>
									<div class="formRow">
										<span class="formText">
											<label for="batch">Batch : </label>
										</span>
										<span class="formField">
											<select name="batchId" id="batchId" class="batchId">

												<?php
													$batchesCnt	= sizeof( $batches );
													
													for( $i=0; $i< $batchesCnt ; $i++){
														if(  $userData[0]['batch_id'] == $batches[$i]['id'] ){
												?>
															<option value="<?php echo $batches[$i]['id']; ?>"><?php echo $batches[$i]['batch']?></option>
												<?php
														}
													}
													for( $i=0; $i< $batchesCnt ; $i++){
														if(  $userData[0]['batch_id'] != $batches[$i]['id'] ){
												?>
															<option value="<?php echo $batches[$i]['id']; ?>"><?php echo $batches[$i]['batch']?></option>
												<?php
														}
													}
												?>
											</select>
										</span>
									</div>
									<div class="formRow">
										<span class="formText">
											<label for="stream">Stream OR Branch: </label>
										</span>
										<span class="formField">
											<select name="streamId" id="streamId" class="streamId">
												<?php
													$streamsCnt	= sizeof( $streams );
													
													for( $i=0; $i< $streamsCnt ; $i++){
														if(  $userData[0]['stream_id'] == $streams[$i]['id'] ){
												?>
															<option value="<?php echo $streams[$i]['id']; ?>"><?php echo $streams[$i]['stream_code']?></option>
												<?php
														}
													}
												?>
	
												<?php
													
													for( $i=0; $i< $streamsCnt ; $i++){
														if(  $userData[0]['stream_id'] != $streams[$i]['id'] ){
												?>
															<option value="<?php echo $streams[$i]['id']; ?>"><?php echo $streams[$i]['stream_code']?></option>
												<?php
														}
													}
												?>
											</select>
										</span>
									</div>
									<div class="formRow">
										<span class="formText">
											<label for="class">Class : </label>
										</span>
										<span class="formField">
											<select name="classId" id="classId" class="classId">
												<?php

													$classCnt	= sizeof( $classes );
													
													for( $i=0; $i< $classCnt ; $i++){
														if( ( empty( $classData ) && PASSOUT == $classes[$i]['id']) || ($classData[0]['class_id'] == $classes[$i]['id']) ){
												?>
															<option value="<?php echo $classes[$i]['id']; ?>"><?php echo $classes[$i]['class_name']?></option>
												<?php
														}
													}
													
													for( $i=0; $i< $classCnt ; $i++){
														if( ( !empty( $classData ) || PASSOUT != $classes[$i]['id']) && ($classData[0]['class_id'] != $classes[$i]['id']) ){
												?>
															<option value="<?php echo $classes[$i]['id']; ?>"><?php echo $classes[$i]['class_name']?></option>
												<?php
														}
													}
												?>
											</select>
										</span>
									</div>
									<div class="formRow">
										<span class="formText">
											<label for="section">Section : </label>
										</span>
										<span class="formField" id="section">
											<select name="sectionId" id="sectionId" class="sectionId">
												<?php if( !empty($classData) ){ ?>
													<option value="<?php echo $classData[0]['section_code'] ?>"><?php echo $classData[0]['section_name'] ?></option>
												<?php } ?>
											</select>
										</span>
									</div>
									<div class="formRow">
										<span class="formText"><label for="admissionId">Admission Id :</label></span>
										<span class="formField"><input type="text" name="admissionId" id="admissionId" value="<?php echo $userData[0]['admission_id'];?>"/></span>
									</div>
									<div class="formRow">
										<span class="formText"><label for="userImage">Image :</label></span>
										<span class="formField"><input type="file" name="usrImage" id="usrImage" /></span>
									</div>
									<div class="formRow">
										<span class="formText"></span>
										<span class="formField">
											<input type="submit" name="update" value="Update Profile" class="sizz" />
											<input type="reset" value="Reset" name="reset" class="sizz"/>
										</span>
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
					</article>
					<article class="col2 pad_left2">
					<?php 
						include_once('sidebar.php');
					?>
					</article>
</div>
</div>
</section>

	
<script type="text/javascript" language="javascript">
	
	$(document).ready(function() {
		
		$('#classId').change( function(){

			var classId	= $('#classId').val();
			$('#section').load('section.php?classId='+classId);
		});
	});
</script>


<?php

	include_once('footer.php');
?>
