<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;

   $classes		= $fcObj->getClasses( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   if( isset ( $_GET['class'] ) ){
   		
		$clsId		= $_GET['class'];
		
   		$classDet	= $fcObj->getClassById($tbClass,$clsId);
   }
   
   if ( isset ( $_POST['editClass'] ) ){
   				
		$varArray['class_id']		= $_POST['classId'];
			
		$varArray['class_name']		= $_POST['className'];
		$varArray['class_code']		= $_POST['classCode'];

		$editClass	= $fcObj->editClass ( $tbClass, $varArray );
		
		if( $editClass ){
			
			header('Location: otheroperations.php');
			return false;
		}else{
   			
			$classDet	= $fcObj->getClassById($tbClass,$_POST['classId']);
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
							<form id='editclass' action='edit_class.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for="classcode">Class Code :</label>
									</div>
									<div class="form_field">
										<input type="text" name="classCode" id="classCode" value="<?php echo $classDet[0]['class_code'];?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for="classname">Class Name :</label>
									</div>
									<div class="form_field">
										<input type="text" name="className" id="className" value="<?php echo $classDet[0]['class_name'];?>" />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type="hidden" name="classId" id="classId" value="<?php echo $classDet[0]['id']; ?>"/>
										<input type='submit' name='editClass' class="button" value='Update Class' />
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

