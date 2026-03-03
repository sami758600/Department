
<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
include_once('../layout/main_header.php');
include_once('../layout/core_forms_style.php');

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');
   $fcObj	= new DataFunctions();

?>
<style type="text/css">
    .committee-form-shell {
        max-width: none;
        margin: 0;
        width: 100%;
    }

    .committee-add-hero {
        border: 1px solid #cfdced;
        border-radius: 18px;
        padding: 18px 22px;
        background:
            linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 16px;
    }

    .committee-add-title {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
    }

    .committee-add-subtitle {
        margin: 8px 0 0;
        color: #556a84;
        font-size: 15px;
    }

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
        display: none;
    }

    #content {
        grid-template-columns: 1fr;
        justify-content: stretch;
        gap: 0;
    }

    #page {
        max-width: none;
    }

    #content_right {
        width: 100%;
    }

    #addcommitteemem .form_row {
        margin-bottom: 16px;
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
    #addcommitteemem .form_field input[type="text"],
    #addcommitteemem .form_field textarea {
        width: 100%;
        min-height: 52px;
        border: 1px solid #c8d8ea;
        border-radius: 12px;
        padding: 11px 14px;
        background: #f6faff;
        font-size: 16px;
        outline: none;
    }

    #addcommitteemem .form_field textarea {
        min-height: 150px;
        resize: vertical;
    }

    #addcommitteemem .form_field select:focus,
    #addcommitteemem .form_field input[type="text"]:focus,
    #addcommitteemem .form_field textarea:focus {
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

    #addcommitteemem .member-photo-preview {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        object-fit: cover;
    }

    .member-upload-wrap {
        border: 1px dashed #bfd3ea;
        border-radius: 12px;
        background: #f8fbff;
        padding: 12px;
    }

    .upload-hint {
        margin-top: 8px;
        color: #6b7f98;
        font-size: 13px;
    }

    .committee-action-bar {
        margin-top: 6px;
        border: 1px solid #dce7f3;
        border-radius: 14px;
        background: #f8fbff;
        padding: 12px;
    }
</style>
<?php
   
   if( isset( $_POST['addCmtMember'] ) ) {
		
		$varArray['committee_cat_id']	= $_POST['cmtCat'];
		$varArray['user_id']			= isset($_POST['userId']) ? intval($_POST['userId']) : 0;
		$varArray['member_name']		= isset($_POST['member_name']) ? trim((string)$_POST['member_name']) : '';
		$varArray['member_about']		= isset($_POST['member_about']) ? trim((string)$_POST['member_about']) : '';
		$varArray['member_image']		= isset($_POST['member_image']) ? trim((string)$_POST['member_image']) : '';

		if (isset($_FILES['member_photo']) && $_FILES['member_photo']['error'] === 0) {
			$uploadName = basename((string)$_FILES['member_photo']['name']);
			$uploadExt = strtolower(pathinfo($uploadName, PATHINFO_EXTENSION));
			$allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'webp');

			if (in_array($uploadExt, $allowedExt)) {
				$newFileName = 'committee_' . time() . '_' . mt_rand(1000, 9999) . '.' . $uploadExt;
				$uploadPath = '../../public/assets/images/users/' . $newFileName;
				if (move_uploaded_file($_FILES['member_photo']['tmp_name'], $uploadPath)) {
					$varArray['member_image'] = $newFileName;
				}
			}
		}
		
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
					<div id='content_left' class='content_left'></div>
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
										$summaryName = trim((string)($CmtMemDet[$j][0]['member_name'] ?? ''));
										$summaryAbout = (string)($CmtMemDet[$j][0]['member_about'] ?? '');
										$summaryImage = trim((string)($CmtMemDet[$j][0]['member_image'] ?? ''));
										$summaryImage = $summaryImage !== '' ? $summaryImage : 'default.png';
							?>
										<div class="comteeMemDetails">
											<div class="wiseCmtMemImage"><img src="<?php echo BASE_URL; ?>/public/assets/images/users/<?php echo rawurlencode($summaryImage);?>" alt="<?php echo htmlspecialchars($summaryName);?>" title="<?php echo htmlspecialchars($summaryName);?>" width="100px" height="100px" /></div>
											<div class="comiteMemName"><?php echo htmlspecialchars($summaryName !== '' ? $summaryName : 'Member');?></div>
											<div class="comiteMemCls"><?php echo htmlspecialchars($summaryAbout);?></div>
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
	   
	   $comitteeCat	= $fcObj->getComiteCatg( $tbComiteCat );

	?>
			
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'></div>
					<div id='content_right' class='content_right'>
						<div class="committee-form-shell">
						<div class="committee-add-hero">
							<h3 class="committee-add-title">Add Committee Member</h3>
							<p class="committee-add-subtitle">Assign a category and create a member profile with optional photo.</p>
						</div>
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
									<input type="hidden" name="userId" id="userId" value="0" />
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='memberName'>Member Name:</label>
									</div>
									<div class="form_field">
										<input type="text" id="memberName" name="member_name" value="" placeholder="Member name" required />
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label for='memberAbout' >About:</label>
									</div>
									<div class="form_field">
										<textarea id="memberAbout" name="member_about" rows="3" placeholder="Member details will appear here."></textarea>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										<label>Profile Photo:</label>
									</div>
									<div class="form_field">
										<div class="member-upload-wrap">
											<input type="hidden" id="memberImage" name="member_image" value="" />
											<input type="file" id="memberPhotoUpload" name="member_photo" accept=".jpg,.jpeg,.png,.gif,.webp" />
											<img id="memberPhoto" class="member-photo-preview" src="" alt="Profile preview" style="display:none;" />
											<div id="memberPhotoPlaceholder">No profile photo selected.</div>
											<div class="upload-hint">Allowed: JPG, PNG, GIF, WEBP</div>
										</div>
									</div>
								</div>
								<div class="form_row">
									<div class="form_label">
										
									</div>
									<div class="form_field">
										<div class="committee-action-bar">
											<input type='submit' name='addCmtMember' class="button" value='Assign' />
										</div>
									</div>
								</div>
							</form>
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
		</div>


<script type="text/javascript" language="javascript">
	
	$(document).ready(function() {
		$('#memberPhotoUpload').on('change', function(){
			if (this.files && this.files[0]) {
				var fileUrl = URL.createObjectURL(this.files[0]);
				$('#memberPhoto').attr('src', fileUrl).show();
				$('#memberPhotoPlaceholder').hide();
			} else {
				$('#memberPhoto').hide().attr('src', '');
				$('#memberPhotoPlaceholder').show();
			}
		});
	});
</script>

<?php 
	include_once('../layout/footer.php');
   }
?>
