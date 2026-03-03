
<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
include_once('../layout/main_header.php');
include_once('../layout/core_forms_style.php');

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');
   $fcObj	= new DataFunctions();

?>
<style type="text/css">
    /* Match Core Settings form/card style on committee assignment page */
    #content_right .login,
    #content_right .comteeMem {
        background: #ffffff;
        padding: 24px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.07);
    }

    #content_left {
        min-height: auto;
    }

    #content_left a {
        display: block;
        text-decoration: none;
        color: #334155;
        font-weight: 600;
        margin-bottom: 8px;
        padding: 9px 12px;
        border-radius: 10px;
        background: #f8fafc;
        transition: all .2s ease;
    }

    #content_left a:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    #addcommitteemem .form_row {
        margin-bottom: 14px;
    }

    #addcommitteemem .form_label {
        margin-bottom: 6px;
    }

    #addcommitteemem .form_label label {
        font-size: 17px;
        font-weight: 700;
        color: #1e293b;
    }

    #addcommitteemem .form_field select,
    #addcommitteemem .form_field input[type="text"] {
        width: 100%;
        min-height: 48px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 10px 12px;
        background: #f8fafc;
        font-size: 15px;
        outline: none;
    }

    #addcommitteemem .form_field select:focus,
    #addcommitteemem .form_field input[type="text"]:focus {
        border-color: #2563eb;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }

    #addcommitteemem .button,
    .comteeMem .button {
        border: 0;
        border-radius: 12px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #0f172a, #1e3a8a);
        color: #fff;
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(30, 58, 138, 0.2);
    }

    #addcommitteemem .button:hover,
    .comteeMem .button:hover {
        filter: brightness(1.06);
    }
</style>
<?php
   
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
					<!-- <div id='content_left' class='content_left'>
						<?php 
							include_once('../layout/leftnav.php');
						?>					
					</div> -->
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
