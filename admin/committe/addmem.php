
<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
include_once('../layout/main_header.php');

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');
   $fcObj	= new DataFunctions();
   
   if( isset( $_POST['addCmtMember'] ) ) {
		
		$varArray['committee_cat_id']	= $_POST['cmtCat'];
		$varArray['user_id']			= $_POST['userId'];
		
		$tbCmt	= TB_COMMITTEE;
	   
		$addCmtMem  = $fcObj->addCommitteeMember($tbCmt,$varArray);
		
	   $tbComtCtg = TB_COMT_CATEG;
	   $tbComt	  = TB_COMMITTEE;
	   
	   $ComtCateg	= $fcObj->getComiteCatg($tbComtCtg);
	   $categoryCnt		= sizeof($ComtCateg);
	   
	   for($i=0; $i<$categoryCnt;$i++){
			
			$categoryId			= $ComtCateg[$i]['id'];
			
			$CmtMemDet[$i]	= $fcObj->getCmtMembers($tbComt,$categoryId);
		}

		?>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
						<?php 
							include_once('../layout/leftnav.php');
						?>					
					</div>
					<div id='content_right' class='content_right'>
						<div class="comteeMemRow">
							<div class="usersDetHeader">
		<?
								echo $addCmtMem;
		?>
							</div>
						</div>
						<div class="comteeMem">
							<div class="comteeMemRow">
							<?php
								
								for($j=0; $j< $categoryCnt; $j++){
								
									if(!empty($CmtMemDet[$j])){
							?>
										<div class="comteeMemDetails">
											<div class="wiseCmtMemImage"><img src="../images/users/<?php echo $CmtMemDet[$j][0]['image'];?>" alt="<?php echo $CmtMemDet[$j][0]['firstname'].' '.$staffDetails[$j][$k]['lastname'];?>" title="<?php echo $CmtMemDet[$j][0]['firstname'].' '.$CmtMemDet[$j][0]['lastname'];?>" width="100px" height="100px" /></div>
											<div class="comiteMemName"><?php echo $CmtMemDet[$j][0]['firstname'].' '.$CmtMemDet[$j][0]['lastname'];;?></div>
											<div class="comiteMemCls"><?php echo $CmtMemDet[$j][0]['section_name'];?></div>
											<div class="comiteCategory"><?php echo $ComtCateg[$j]['category_name'];?></div>
											<br class="clearfix" />
										</div>
							<?php 
									}
								} 
							?>
							</div>
							<div class="comteeMemRow">
								<div class="comteeMemDetails">
									<a href="addmem.php">
										<input type="submit" class="button" name="addmember" value="Add Committee Member" />
									</a>
								</div>
							</div>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				<?php 
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		<?php
			include_once('../layout/footer.php');
   }else{
		
	   $tbComiteCat	= TB_COMT_CATEG;
	   $tbClass		= TB_CLASS;
	   
	   $comitteeCat	= $fcObj->getComiteCatg( $tbComiteCat );
	   $classes		= $fcObj->getClassesWOPO( $tbClass );

	?>
			
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
						<?php 
							include_once('../layout/leftnav.php');
						?>					
					</div>
					<div id='content_right' class='content_right'>
						<div class="login">
							<form id='addcommitteemem' action='addmem.php' method='POST' accept-charset='UTF-8' enctype="multipart/form-data">
								<div class="form_row">
									<div class="form_label">
										<label for='committeeCateg' >Committee Category:</label>
									</div>
									<div class="form_field">
										<select name="cmtCat" id="cmtCat" class="cmtCat">
											<option value="">SELECT</option>
											<?php
												$cmtCatCnt	= sizeof( $comitteeCat );
												
												for( $i=0; $i< $cmtCatCnt ; $i++){
											?>
													<option value="<?php echo $comitteeCat[$i]['id']; ?>"><?php echo $comitteeCat[$i]['category_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='class' >Class:</label>
									</div>
									<div class="form_field">
										<select name="classId" id="classId" class="classId">
											<option value="">SELECT</option>
											<?php
												$classCnt	= sizeof( $classes );
												
												for( $i=0; $i< $classCnt ; $i++){
											?>
													<option value="<?php echo $classes[$i]['id']; ?>"><?php echo $classes[$i]['class_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='section' >Section:</label>
									</div>
									<div class="form_field" id="section">
										<select name="sectionId" id="sectionId" class="sectionId">
											<option value="">SELECT</option>
											
										</select>
									</div>
								</div>
								<div class="form_row" id='users'>
				
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<input type='submit' name='addCmtMember' class="button" value='Assign' />
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


<script type="text/javascript" language="javascript">
	
	$(document).ready(function() {
		
		$('#classId').change( function(){

			var classId	= $('#classId').val();
			$('#section').load('section.php?classId='+classId);
		});
	});
</script>

<?php 
	include_once('../layout/footer.php');
   }
?>