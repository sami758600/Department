<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   $tbSubject	= TB_SUBJECTS;

   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   if( isset ( $_GET['subject'] ) ){
   		
		$subjId		= $_GET['subject'];
		
   		$subjDet	= $fcObj->getSubjectById($tbSubject,$subjId);
   }
   
   if ( isset ( $_POST['editSubject'] ) ){
   				
		$varArray['class_id']		= $_POST['clsId'];
		$varArray['subj_id']		= $_POST['subId'];
			
		$varArray['subj_name']		= $_POST['subName'];
		$varArray['subj_code']		= $_POST['subCode'];

		$editSubj	= $fcObj->editSubject ( $tbSubject, $varArray );
		
		if( $editSubj ){
			
			header('Location: subjects.php');
			return false;
		}else{
   			
			$sectionDet	= $fcObj->getSubjectById($tbSubject,$_POST['subId']);
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
							<form id='editsubject' action='edit_subjects.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for="classcode">Class Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="clsName" id="clsName" value="<?php echo $subjDet[0]['class_code'];?>" readonly="readonly" />
										<input type="hidden" name="clsId" id="clsId" value="<?php echo $subjDet[0]['class_id'];?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="sectioncode">Subject Code :</label>
									</div>
									<div class="form_field">
										<input type="text" name="subCode" id="subCode" value="<?php echo $subjDet[0]['sub_code'];?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="sectionname">Subject Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="subName" id="subName" value="<?php echo $subjDet[0]['sub_name'];?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type="hidden" name="subId" id="subId" value="<?php echo $subjDet[0]['id']; ?>"/>
										<input type='submit' name='editSubject' class="button" value='Update Subject' />
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

