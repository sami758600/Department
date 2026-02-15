<?php 
	
	

   require_once("../libraries/functions.class.php") ;

   $fcObj		= new DataFunctions();
   
   $tbStream	= TB_STREAM;

   if ( isset ( $_POST['addNewBranch'] ) ){
   				
		$varArray['branch_code']		= $_POST['branchCode'];
		$varArray['branch_name']		= $_POST['branchName'];
		
		$addBranch	= $fcObj->addBranch ( $tbStream, $varArray );
		
		if( $addBranch ){
			
			header('Location: branch.php');
			return false;
		}else{
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
							include_once('other_leftnav.php');
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
							<form id='addBatch' action='add_branch.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for="branchcode">Branch Code :</label>
									</div>
									<div class="form_field">
										<input type="text" name="branchCode" id="branchCode" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="brnachname">Batch Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="branchName" id="branchName" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type='submit' name='addNewBranch' id="addNewBranch" class="button" value='Add Branch' />
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