<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbStream	= TB_STREAM;

   if( isset ( $_GET['branch'] ) ){
   		
		$branchId	= $_GET['branch'];
		
   		$branchDet	= $fcObj->getBranchById($tbStream,$branchId);
   }
   
   if ( isset ( $_POST['editBranch'] ) ){
   				
		$varArray['branch_id']		= $_POST['branchId'];
		
		$varArray['branch_code']	= $_POST['branchCode'];			
		$varArray['branch_name']	= $_POST['branchName'];

		$editBranch	= $fcObj->editBranch ( $tbStream, $varArray );
		
		if( $editBranch ){
			
			header('Location: branch.php');
			return false;
		}else{
   			
			$branchDet	= $fcObj->getBranchById($tbStream,$_POST['branchId']);
			$msg	= 'Sorry, Please try again';
		}
   }

	include_once('main_header.php');

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
						<?php 
							include_once('admin/other_leftnav.php');
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
							<form id='editclass' action='edit_branch.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for="branchcode">Branch Code :</label>
									</div>
									<div class="form_field">
										<input type="text" name="branchCode" id="branchCode" value="<?php echo $branchDet[0]['stream_code'];?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="branchname">Branch Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="branchName" id="branchName" value="<?php echo $branchDet[0]['stream_name'];?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type="hidden" name="branchId" id="branchId" value="<?php echo $branchDet[0]['id']; ?>"/>
										<input type='submit' name='editBranch' class="button" value='Update Branch' />
									</div>
								</div>
							</form>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				<?php 
					include_once('admin/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('admin/footer.php');
?>

