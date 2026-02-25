<?php 
   require_once("../libraries/functions.class.php") ;

   $fcObj		= new DataFunctions();
   
  $tbComments	= TB_COMMENTS;
   
  if ( isset ( $_POST['addNewComment'] ) ){
   	
		$varArray['comType']	= $_POST['commentatorType'];
		$varArray['comName']	= $_POST['commentatorName'];
		$varArray['comQualif']	= str_replace(',','\,',$_POST['commentatorQualif']);
		$varArray['comDesig']	= $_POST['commentatorDesig'];
		$varArray['comComment']	= $_POST['commentatorComment'];
		
		$fileName	= $_POST['commentatorType'].'.png';
		
		if ((move_uploaded_file($_FILES['commentatorImage']['tmp_name'], "../images/".$fileName))){
								
			$fileName 	= $fileName;
		}else{
		
			$fileName 	= '';
		}
		
		$varArray['image']	= $fileName;

		$changeComments	= $fcObj->changeComments ( $tbComments, $varArray );
		
		if( $changeComments ){
			
			header('Location: index.php');
			return false;
		}else{
			$msg	= 'Sorry, Please try again';
		}
   }
 
   $itHodComment	= $fcObj->getComment( $tbComments, HOD );
   
   $princComment	= $fcObj->getComment( $tbComments, PRINCIPAL );
   
 	include_once('header.php');
	
?>
			<div id="page">
				<div id="content">
					<div class="post">
						<h2>Welcome to AIML Department</h2>
						<p class="mainContent">
							
						</p>
					</div>
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
					<form id='addComment' action='changecomments.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
						<div class="form_row">
							<div class="form_label">
								<label for='commentator' >Commentator:</label>
							</div>
							<div class="form_field">
								<select name="commentatorType" id="commentatorType" class="commentatorType">
									<option value="">SELECT</option>
									<option value="<?php echo CHAIRMAN;?>"><?php echo CHAIRMAN;?></option>
									<option value="<?php echo PRINCIPAL;?>"><?php echo PRINCIPAL;?></option>
									<option value="<?php echo HOD;?>"><?php echo HOD;?></option>
								</select>
							</div>
						</div>
						<div class="form_row">
							<div class="form_label">
								<label for='name' >Commentator Name:</label>
							</div>
							<div class="form_field">
								<input type="text" name="commentatorName" id="commentatorName" class="commentatorName" value="" />
							</div>
						</div>
						<div class="form_row">
							<div class="form_label">
								<label for='commentatorQualif' >Qualification:</label>
							</div>
							<div class="form_field"> 
								<input type="text" name="commentatorQualif" id="commentatorQualif" class="commentatorQualif" value="" />
							</div>
						</div>
						<div class="form_row">
							<div class="form_label">
								<label for='commentatorDesig' >Designation:</label>
							</div>
							<div class="form_field"> 
								<input type="text" name="commentatorDesig" id="commentatorDesig" class="commentatorDesig" value="" />
							</div>
						</div>
						<div class="form_row">
							<div class="form_label">
								<label for='eventVenue' >Comment:</label>
							</div>
							<div class="form_field">
								<textarea rows="5" cols="17" name="commentatorComment" id="commentatorComment" class="commentatorComment"></textarea>
							</div>
						</div>
						<div class="formRow">
							<div class="form_label">
								<label for="userImage">Image :</label>
							</div>
							<div class="form_field">
								<input type="file" name="commentatorImage" id="commentatorImage" />
							</div>
						</div>
									
						<div class="form_row">
							<div class="form_label">
								
							</div>
							<div class="form_field">
								<input type='submit' name='addNewComment' class="button" value='Add Comment' />
							</div>
						</div>						
					</form>
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
