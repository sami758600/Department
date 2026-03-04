<?php
	
	include_once("mysql.class.php");

	class DataFunctions {

		public $dbObj;
		public function __construct(){
			$this->dbObj = new DataBasePDO();
	}


	 /*
	  *  For admin functions
	  */
	 
	 public function adminLogin($table,$adminName){

			$sqlQuery	= 'SELECT id, adminname, password, firstname, mail_id, image FROM '.$table.' WHERE adminname = "'.$adminName.'"';

			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	 }


	/*
	 *  CHANGE ADMIN PASSWORD
	 */
	 public function changeAdminPassWord($table, $varArray){
			
			$aName		= $varArray['admin_name'];
			$pass		= $varArray['pass_word'];
			
			$sqlQuery	= 'UPDATE '.$table.' SET password = "'.$pass.'" WHERE adminname = "'.$aName.'"';

			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	 }

	/*
	 *  User Registration
	 */
	 public function regUser($table,$varArray){
			
			$uName		= $varArray['username'];			
			$admId		= $varArray['admission_id'];
			
			$tbUser		= TB_USERS;

			$checkUser	= $this->userCheck($tbUser,$uName);
			
			$admIdCheck	= $this->admsnIdCheck($tbUser,$admId);
			
			if( empty($checkUser) && empty($admIdCheck) ){

				$status = isset($varArray['status']) ? (int)$varArray['status'] : 0;
				$username = addslashes((string)$varArray['username']);
				$password = addslashes((string)$varArray['password']);
				$mailId = addslashes((string)$varArray['mail_id']);
				$firstName = addslashes((string)$varArray['firstname']);
				$lastName = addslashes((string)$varArray['lastname']);
				$gender = addslashes((string)$varArray['gender']);
				$address = addslashes((string)$varArray['address']);
				$mobileNo = addslashes((string)$varArray['mobile_no']);
				$batchId = (int)$varArray['batch_id'];
				$streamId = (int)$varArray['stream_id'];
				$section = addslashes((string)$varArray['section']);
				$admissionId = addslashes((string)$varArray['admission_id']);
				$image = addslashes((string)$varArray['image']);

                $values = "(
                '".$username."',
                '".$password."',
                '".$mailId."',
                '".$firstName."',
                '".$lastName."',
                '".$gender."',
                '".$address."',
                '".$mobileNo."',
                '".$batchId."',
                '".$streamId."',
                '".$section."',
                '".$admissionId."',
                '".$image."',
                '".$status."'
                )";


				$sql		= 'INSERT INTO '.$table.'(username, password, mail_id, firstname, lastname, gender, address, mobile_no, batch_id, stream_id, section, admission_id, image, status) VALUES '.$values;

				$result		= $this->dbObj->executeQuery($sql);

			}else if ( empty($admIdCheck) ) {
				
				$result		= 'username already taken';
			}else if ( empty($checkUser) ) {
				
				$result		= 'With This Admission Id, User Already Registered';
			}else{
			
				$result		= 'username AND Admission Id Are Already Taken';
			}
			return $result;
	 }

	/*
	 *  Checking User
	 */
	 public function userCheck($table,$uName){
			
			$sqlQuery	= 'SELECT id, username, password, firstname, lastname, mail_id, admission_id, batch_id, stream_id, section, gender, address, mobile_no, image, status FROM '.$table.' WHERE username = "'.$uName.'" ';

			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	 }
	 
	/*
	 *  CHANGE USER PROFILE
	 */
	 public function changeUserProfile($table, $varArray, $uName){
			
			
			$newUName	= $varArray['username'];
			$pass		= $varArray['password'];
			$mail		= $varArray['mail_id'];
			$fName		= $varArray['firstname'];
			$lName		= $varArray['lastname'];
			$gender		= $varArray['gender'];
			$addr		= $varArray['address'];
			$phone		= $varArray['mobile_no'];
			$batch		= $varArray['batch_id'];
			$stream		= $varArray['stream_id'];
			$section	= $varArray['section'];
			$admId		= $varArray['admission_id'];
			$image		= $varArray['image'];

			$sqlQuery	= 'UPDATE '.$table.' SET username = "'.$newUName.'", password = "'.$pass.'", firstname = "'.$fName.'", lastname = "'.$lName.'", gender = "'.$gender.'", address = "'.$addr.'", mobile_no = "'.$phone.'", batch_id = "'.$batch.'", stream_id = "'.$stream.'", section = "'.$section.'", admission_id = "'.$admId.'", image = "'.$image.'", mail_id = "'.$mail.'"  WHERE username = "'.$uName.'"';

			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	 }

	/*
	 *  Checking Admission Id
	 */
	 public function admsnIdCheck($table,$admsnId){
			
			$sqlQuery	= 'SELECT id, username, password, firstname, mail_id, admission_id, image, status FROM '.$table.' WHERE admission_id = "'.$admsnId.'" ';

			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	 }
	 
	/*
	 *  GET TEMPORARY USERS
	 */
	 public function getTempUsers($table){
			
			$sqlQuery	= 'SELECT id, username, password, firstname, lastname, mail_id, admission_id, image, status FROM '.$table.' WHERE status = 0';

			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	 }
	 
	/*
	 *  APPROVE USER
	 */
	 public function approveUser($table, $userId){
			
			$sqlQuery	= 'UPDATE '.$table.' SET status = 1 WHERE id = '.$userId;

			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	 }

	/*
	 *  CHANGE PASSWORD
	 */
	 public function changeUserPassWord($table, $varArray){
			
			$uName		= $varArray['user_name'];
			$pass		= $varArray['pass_word'];
			
			$sqlQuery	= 'UPDATE '.$table.' SET password = "'.$pass.'" WHERE username = "'.$uName.'"';

			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	 }

	/*
	 *  DELETE USERS
	 */
	 public function deleteUser($table, $userId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$userId;

			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	 }

	 /*
	 *  Random Quotations
	 */
	 public function getQuotes($table){
			
			$sqlQuery	= "SELECT id,quote,bywhom FROM $table ORDER BY RAND() LIMIT 1";
			
			$result		= $this->dbObj->getOneRow($sqlQuery);
			
			return $result;
	 }

	/*
	 *  Random Comments
	 */
	 public function getComments($table){
			
			$sqlQuery	= "SELECT comts.id,user.firstname,user.lastname,comment FROM $table comts, users user WHERE comts.user_id = user.id AND is_approved = 1 ORDER BY id DESC LIMIT 3";
			
			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	 }

	/*
	 *  Place Comment
	 */
	 public function dropFewWords($table,$userId,$comment){
			
			$sql		= 'INSERT INTO '.$table.' (user_id, comment , is_approved ) VALUES ( '.$userId.', "'.$comment.'", 0 ) ';
			
			$result		= $this->dbObj->executeQuery($sql);
			
			return $result;
	 }	 

	/*
	 *  Get Users
	 */
	 public function getUsers($table){

			$sql		= 'SELECT id,username,mail_id FROM '.$table;

			$result		= $this->dbObj->getAllResults($sql);
						
			return $result;
	 }	

	/*
	 *  Get Approved Users For Committee Assignment
	 */
	 public function getApprovedUsersForCommittee($table){

			$sql		= 'SELECT id, firstname, lastname, address, image
						   FROM '.$table.'
						   WHERE status = 1
						   ORDER BY firstname ASC, lastname ASC';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 }	
	 
	/*
	 *  Get New Comments
	 */
	 public function getNewComments($table){

			$sql		= 'SELECT commts.id,commts.user_id,user.username,user.firstname,user.lastname,commts.comment FROM '.$table.' commts, users user WHERE commts.user_id = user.id AND is_approved = 0';

			$result		= $this->dbObj->getAllResults($sql);
						
			return $result;
	 }	
	 
	/*
	 *  Approve Comments
	 */
	 public function approveComments($table,$valueArray){

			$noOfChecked	= sizeof($valueArray);

			for($i = 0; $i < $noOfChecked; $i++){
				
				$value		= $valueArray[$i];

				$sql		= 'UPDATE '.$table.' SET is_approved = 1 WHERE id = '.$value;

				$result[$i]	= $this->dbObj->executeQuery($sql);
			}
						
			return $result;
	 }	
	
	/*
	 *  Add Quotations
	 */
	 public function addQuotation($table,$quotation,$quoteBy){

			$sql		= 'INSERT INTO '.$table.' (quote, bywhom ) VALUES ( "'.$quotation.'", "'.$quoteBy.'" ) ';
			
			$result		= $this->dbObj->executeQuery($sql);
			
			return $result;
	 }	
	 
	/*
	 *  Admin Registration
	 */
	 public function adminRegistration($table,$varArray){
			
			$uName		= $varArray['adminname'];			
			
			$checkUser	= $this->adminLogin($table,$uName);
			
			if( empty($checkUser) ){

				$values		= "('".implode("','", $varArray)."')";

				$sql		= 'INSERT INTO '.$table.'(adminname, password, mail_id, firstname, lastname, gender, address, mobile_no, qualification) VALUES '.$values;

				$result		= $this->dbObj->executeQuery($sql);

			}else{
				
				$result		= 'username already taken';
			}
			return $result;
	 }
	 
	/*
	 *  GET BATCHES
	 */
	 public function getBatches($table){
			
			$sql		= 'SELECT 
								id, batch
						   FROM 
						   		'.$table.'
						   WHERE
						   		1';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 

	/*
	 *  Add BATCH
	 */
	 public function addBatch($table,$varArray){

			$batchName	= $varArray['batch_name'];
			
			$sql		= 'INSERT INTO '.$table.' (batch ) VALUES ( "'.$batchName.'") ';
			
			$result		= $this->dbObj->executeQuery($sql);
			
			return $result;
	 }	
	 
	/*
	 *  UPDATE BATCH
	 */
	 public function editBatch($table, $varArray){
			
			$batchId		= $varArray['batch_id'];
			$batchName		= $varArray['batch_name'];

			$sqlQuery		= 'UPDATE '.$table.' SET batch = "'.$batchName.'" WHERE id = '.$batchId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}
	
	/*
	 *  GET BATCH BY ID
	 */
	 public function getBatchById($table,$batchId){
			
			$sql		= 'SELECT 
								id, batch 
						   FROM 
						   		'.$table.'
						   WHERE
						   		id = '.$batchId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 
	
	/*
	 *  DELETE BATCH
	 */
	 public function deleteBatch($table, $batchId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$batchId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET STREAMS
	 */
	 public function getStreams($table){
			
			$sql		= 'SELECT 
								id, stream_code, stream_name 
						   FROM 
						   		'.$table.'
						   WHERE
						   		1';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 

	/*
	 *  Add BRANCH
	 */
	 public function addBranch($table,$varArray){

			$branchCode	= $varArray['branch_code'];
			$branchName	= $varArray['branch_name'];
			
			$sql		= 'INSERT INTO '.$table.' ( stream_code , stream_name ) VALUES ( "'.$branchCode.'", "'.$branchName.'") ';
			
			$result		= $this->dbObj->executeQuery($sql);
			
			return $result;
	 }	
	 
	/*
	 *  UPDATE BRANCH
	 */
	 public function editBranch($table, $varArray){
			
			$branchId		= $varArray['branch_id'];
			$branchCode		= $varArray['branch_code'];
			$branchName		= $varArray['branch_name'];

			$sqlQuery		= 'UPDATE '.$table.' SET stream_code = "'.$branchCode.'", stream_name = "'.$branchName.'" WHERE id = '.$branchId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}
	
	/*
	 *  GET BATCH BY ID
	 */
	 public function getBranchById($table,$branchId){
			
			$sql		= 'SELECT 
								id, stream_code, stream_name 
						   FROM 
						   		'.$table.'
						   WHERE
						   		id = '.$branchId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 
	
	/*
	 *  DELETE BRANCH
	 */
	 public function deleteBranch($table, $branchId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$branchId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET CLASSES
	 */
	 public function getClasses($table){
			
			$sql		= 'SELECT 
								id, class_code, class_name 
						   FROM 
						   		'.$table.'
						   WHERE
						   		1';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 

	/*
	 *  GET CLASSES WITHOUT PASSOUT
	 */
	 public function getClassesWOPO($table){
			
			$sql		= 'SELECT 
								id, class_code, class_name 
						   FROM 
						   		'.$table.'
						   WHERE
						   		id != 0';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 
	
	/*
	 *  GET CLASSES BY ID
	 */
	 public function getClassById($table,$classId){
			
			$sql		= 'SELECT 
								id, class_code, class_name 
						   FROM 
						   		'.$table.'
						   WHERE
						   		id = '.$classId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 
	
	/*
	 *  Add CLASS
	 */
	 public function addClass($table,$varArray){

			$classCode	= $varArray['class_code'];
			$className	= $varArray['class_name'];
			
			$sql		= 'INSERT INTO '.$table.' (class_code, class_name ) VALUES ( "'.$classCode.'", "'.$className.'" ) ';
			
			$result		= $this->dbObj->executeQuery($sql);
			
			return $result;
	 }	
	 
	/*
	 *  UPDATE CLASS
	 */
	 public function editClass($table, $varArray){
			
			$classId		= $varArray['class_id'];
			$clsName		= $varArray['class_name'];
			$clsCode		= $varArray['class_code'];

			$sqlQuery		= 'UPDATE '.$table.' SET class_code = "'.$clsCode.'", class_name = "'.$clsName.'" WHERE id = '.$classId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  DELETE CLASS
	 */
	 public function deleteClass($table, $classId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$classId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET CLASS BY SECTION
	 */
	 public function getClsBySec($table,$secId){
			$where = 'sec.section_code = "'.$secId.'"';
			if (is_numeric($secId)) {
				$where = 'sec.id = '.$secId;
			}

			$sql		= 'SELECT
								sec.id section_id, sec.section_code, sec.section_name , cls.id class_id, cls.class_code, cls.class_name 
						   FROM 
						   		class cls,
								'.$table.' sec
								
						   WHERE
						   		'.$where.'
							AND
								sec.class_id = cls.id';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 

	/*
	 *  GET SECTION
	 */
	 public function getSections($table,$classId=NULL){
			
			if( $classId != NULL){
			
				$where	= 'class_id = '.$classId;
			}else{
				
				$where	= '';
			}
			 
			$sql		= 'SELECT 
								id, section_code, section_name 
						   FROM 
						   		'.$table.'
						   WHERE
						   		'.$where;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 
	 
	/*
	 *  GET SECTION BY ID
	 */
	 public function getSectionById($table,$secId){
			
			$sql		= 'SELECT 
								tb.id, tb.section_code, tb.section_name, cls.class_name, cls.class_code, cls.id class_id
						   FROM 
						   		'.$table.' tb, class cls
						   WHERE
						   		tb.class_id = cls.id
							AND 
								tb.id = '.$secId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 
	
	/*
	 *  Add SECTION
	 */
	 public function addSection($table,$varArray){

			$clsId		= $varArray['class_id'];
			$secCode	= $varArray['section_code'];
			$secName	= $varArray['section_name'];
			
			$sql		= 'INSERT INTO '.$table.' ( class_id, section_code, section_name ) VALUES ( "'.$clsId.'", "'.$secCode.'", "'.$secName.'" ) ';
			
			$result		= $this->dbObj->executeQuery($sql);
			
			return $result;
	 }	
	 
	/*
	 *  UPDATE SECTION
	 */
	 public function editSection($table, $varArray){
			
			$classId		= $varArray['class_id'];
			$secId			= $varArray['sec_id'];

			$secName		= $varArray['sec_name'];
			$secCode		= $varArray['sec_code'];

			$sqlQuery		= 'UPDATE '.$table.' SET class_id = "'.$classId.'", section_code = "'.$secCode.'", section_name = "'.$secName.'" WHERE id = '.$secId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  DELETE SECTION
	 */
	 public function deleteSection($table, $sectionId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$sectionId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET STAFF CATEGORIES
	 */
	 public function getStaffCategories($table){
						 
			$sql		= 'SELECT 
								id, category_name
						   FROM 
						   		'.$table;

			$result		= $this->dbObj->getAllResults($sql);
			
			return $result;
	 } 

	/*
	 *  ADD STAFF DETAILS
	 */
	 public function addStaffDetails($table,$varArray){
			
			$categId	= $varArray['staffType'];
			$firstName	= $varArray['firstName'];
			$lastName	= $varArray['lastName'];
			$stafQualif	= $varArray['staffQualif'];
			$stafDesig	= $varArray['staffDesig'];
			$email		= $varArray['email'];
			
			$indusExp	= $varArray['indusExp'];
			$teachExp	= $varArray['teachingExp'];
			
			$research	= $varArray['research'];

			$pubNat			= $varArray['pub_nat'];
			$pubInternat	= $varArray['pub_internat'];

			$confNat		= $varArray['conf_nat'];
			$confInternat	= $varArray['conf_internat'];

			$image		= $varArray['image'];
			 
			$sql		= 'INSERT INTO '.$table.' (staff_categ_id, first_name, last_name, qualification, designation, industry_exp, teach_exp, research, publ_national, publ_international, conf_national, conf_international, e_mail, image) 
							VALUES("'.$categId.'","'.$firstName.'","'.$lastName.'","'.$stafQualif.'","'.$stafDesig.'","'.$indusExp.'","'.$teachExp.'","'.$research.'","'.$pubNat.'","'.$pubInternat.'","'.$confNat.'","'.$confInternat.'","'.$email.'","'.$image.'")';

			$result		= $this->dbObj->executeQuery($sql);

			return $result;
	 } 

	/*
	 *  EDIT STAFF DETAILS
	 */
	 public function editStaffDetails($table,$staffId,$varArray){
			
			$categId	= $varArray['staffType'];
			$firstName	= $varArray['firstName'];
			$lastName	= $varArray['lastName'];
			$stafQualif	= $varArray['staffQualif'];
			$stafDesig	= $varArray['staffDesig'];
			$email		= $varArray['email'];
			
			$indusExp	= $varArray['indusExp'];
			$teachExp	= $varArray['teachingExp'];
			
			$research	= $varArray['research'];

			$pubNat			= $varArray['pub_nat'];
			$pubInternat	= $varArray['pub_internat'];

			$confNat		= $varArray['conf_nat'];
			$confInternat	= $varArray['conf_internat'];

			$image		= $varArray['image'];
			 
			$sql		= 'UPDATE '.$table.' 
							SET staff_categ_id = "'.$categId.'", first_name = "'.$firstName.'", last_name = "'.$lastName.'", qualification = "'.$stafQualif.'", designation = "'.$stafDesig.'", industry_exp = "'.$indusExp.'", teach_exp = "'.$teachExp.'", research = "'.$research.'", publ_national = "'.$pubNat.'", publ_international = "'.$pubInternat.'", conf_national = "'.$confNat.'", conf_international = "'.$confInternat.'", e_mail = "'.$email.'", image = "'.$image.'" 
							WHERE id = '.$staffId;

			$result		= $this->dbObj->executeQuery($sql);

			return $result;
	 } 

	/*
	 *  GET STAFF DETAILS
	 */
	 public function getStaffDetails($table,$categoryId=NULL){
			
			if( $categoryId != NULL){
			
				$where	= 'staff_categ_id = '.$categoryId;
			}else{
				
				$where	= 1;
			}
			 
			$sql		= 'SELECT 
								id, first_name, last_name, designation, image, qualification 
						   FROM 
						   		'.$table.'
						   WHERE
						   		'.$where;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 
	 
	/*
	 *  GET STAFF DETAILS BY ID
	 */
	 public function getStaffDetailsById($table,$id=NULL){
			
			if( $id != NULL){
			
				$where	= 'id = '.$id;
			}else{
				
				$where	= 1;
			}
			 
			$sql		= 'SELECT 
								staff_categ_id, first_name, last_name, qualification, designation, industry_exp, teach_exp, research, e_mail, image, publ_national, publ_international, conf_national, conf_international 
						   FROM 
						   		'.$table.'
						   WHERE
						   		'.$where;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 
	 
	/*
	 *  DELETE STAFF
	 */
	 public function deleteStaff($table,$id){
			
			
			$sql		= 'DELETE
								 
						   FROM 
						   		'.$table.'
						   WHERE
						   		id = '.$id;
 
			$result		= $this->dbObj->executeQuery($sql);

			return $result;
	 } 

	/*
	 *  GET WISE COMMITTEE CATEGORIES
	 */
	 public function getComiteCatg($table){
						 
			$sql		= 'SELECT 
								id, category_name
						   FROM 
						   		'.$table;

			$result		= $this->dbObj->getAllResults($sql);
			
			return $result;
	 } 

	/*
	 *  GET STAFF DETAILS
	 */
	 public function getCmtMembers($table,$categoryId){
			$this->ensureCommitteeMemberColumns($table);
			
			$sql		= 'SELECT
								tb.id,
								COALESCE(NULLIF(tb.member_name, ""), CONCAT_WS(" ", usr.firstname, usr.lastname)) AS member_name,
								COALESCE(NULLIF(tb.member_about, ""), usr.address, "") AS member_about,
								COALESCE(NULLIF(tb.member_image, ""), usr.image, "") AS member_image
						   FROM
						   		'.$table.' tb
						   LEFT JOIN
						   		users usr
						   ON
						   		tb.user_id = usr.id
						   WHERE
						   		tb.committee_cat_id = '.$categoryId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 

	/*
	 *  Ensure committee table supports manual member fields
	 */
	 public function ensureCommitteeMemberColumns($table){
			$columns = array(
				'member_name' => 'VARCHAR(255) NOT NULL DEFAULT ""',
				'member_about' => 'TEXT NULL',
				'member_image' => 'VARCHAR(255) NOT NULL DEFAULT ""'
			);

			foreach($columns as $columnName => $definition){
				$columnCheck = $this->dbObj->getAllResults('SHOW COLUMNS FROM '.$table.' LIKE "'.$columnName.'"');
				if( empty($columnCheck) ){
					$this->dbObj->executeQuery('ALTER TABLE '.$table.' ADD COLUMN '.$columnName.' '.$definition);
				}
			}

			return true;
	 }
	 
	/*
	 *  GET ALL PAST EVENTS
	 */
	 public function getPastEvents($table,$eventType){
			
			$month			= date("M Y");
			
			$startDate		= date('Y-m-01',strtotime($month));
			$endDate		= date('Y-m-t',strtotime($month));
			
			$sql		= 'SELECT 
								id, event_name, is_registration, event_date, reg_frm_date, reg_to_date
						   FROM 
						   		'.$table.'
						   WHERE
						   		event_type_id = '.$eventType.'
							AND
								event_date < "'.$startDate.'"';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET ALL CURRENT EVENTS
	 */
	 public function getCurrentEvents($table,$eventType){
			
			$month			= date("M Y");
			
			$startDate		= date('Y-m-01',strtotime($month));
			$endDate		= date('Y-m-t',strtotime($month));
			
			$sql		= 'SELECT 
								id, event_name, is_registration, event_date, reg_frm_date, reg_to_date
						   FROM 
						   		'.$table.'
						   WHERE
						   		event_type_id = '.$eventType.'
							AND
								event_date BETWEEN "'.$startDate.'" AND "'.$endDate.'"';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 
	
	/*
	 *  GET ALL FUTURE EVENTS
	 */
	 public function getFutureEvents($table,$eventType){
			
			$month			= date("M Y");
			
			$startDate		= date('Y-m-01',strtotime($month));
			$endDate		= date('Y-m-t',strtotime($month));
			
			$sql		= 'SELECT 
								id, event_name, is_registration, event_date, reg_frm_date, reg_to_date
						   FROM 
						   		'.$table.'
						   WHERE
						   		event_type_id = '.$eventType.'
							AND
								event_date > "'.$endDate.'"';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET EVENT DETAILS
	 */
	 public function getEventDetails($table,$eventId=NULL){
			
			if( $eventId==NULL ){
				$where	= 1;
			}else{
				$where	= 'id = '.$eventId;
			}
			
			$sql		= 'SELECT 
								id, event_name, event_desc, event_address, event_type_id, is_registration, event_date, reg_frm_date, reg_to_date
						   FROM 
						   		'.$table.'
						   WHERE
						   		'.$where;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  UPDATE EVENT DETAILS
	 */
	 public function updateEvent($table, $varArray, $eventId){
			
			$eventType		= $varArray['event_type_id'];
			$eventName		= $varArray['event_name'];
			$eventDesc		= $varArray['event_desc'];
			$eventAddr		= $varArray['event_address'];
			$eventDate		= $varArray['event_date'];
			$eventFrmDate	= $varArray['reg_frm_date'];
			$eventToDate	= $varArray['reg_to_date'];
			$isRegis		= $varArray['is_registration'];
				
			$sql			= 'UPDATE '.$table.' SET event_type_id = '.$eventType.', event_name = "'.$eventName.'", event_desc = "'.$eventDesc.'", event_address = "'.$eventAddr.'" , event_date = "'.$eventDate.'", reg_frm_date = "'.$eventFrmDate.'", reg_to_date = "'.$eventToDate.'", is_registration = "'.$isRegis.'" WHERE id = '.$eventId;

			$result			= $this->dbObj->executeQuery($sql);
			
			return $result;
	 } 
	 
	/*
	 *  GET EVENT REGISTRATION CHECK
	 */
	 public function eventRegCheck($table,$eventId,$userId){
			
			$sql		= 'SELECT 
								tb.id, tb.event_id, tb.user_id, evt.event_name
						   FROM 
						   		'.$table.' tb,
								events evt
						   WHERE
						   		tb.event_id = '.$eventId.'
							AND
								tb.user_id	= '.$userId.'
							AND
								tb.event_id = evt.id';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET EVENT REGISTRATION 
	 */
	 public function eventRegister($table,$eventId,$userId){
			
			$sql		= 'INSERT INTO
							'.$table.' ( event_id, user_id, status)
							VALUES ( '.$eventId.', '.$userId.', 0 )';

			$result		= $this->dbObj->executeQuery($sql);

			return $result;
	 } 	 

	/*
	 *  GET EVENTS FOR SHORT LISTED
	 */
	 public function getShortListedEvents($table,$eventType){
			
			$today		= date('Y-m-d');
			$endDay		= date('Y-m-d', strtotime('2 day', strtotime($today)));
			
			$sql		= 'SELECT 
								id, event_name, is_registration, event_date, reg_frm_date, reg_to_date
						   FROM 
						   		'.$table.'
						   WHERE
						   		event_type_id = '.$eventType.'
							AND
								event_date BETWEEN "'.$today.'" AND "'.$endDay.'"';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET EVENTS FOR REGISTERED CANDIDATES (ADMIN)
	 */
	 public function getRegisteredCandidateEvents($table,$eventType){
			
			$sql		= 'SELECT 
								id, event_name, is_registration, event_date, reg_frm_date, reg_to_date
						   FROM 
						   		'.$table.'
						   WHERE
						   		event_type_id = '.$eventType.'
							AND
								is_registration = 1
						   ORDER BY
						   		event_date DESC';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET EVENT SHORT LIST CANDIDATES 
	 */
	 public function getEventSLCand($table,$eventId){
			
			$sql		= 'SELECT
								usr.id, usr.firstname, usr.lastname, str.stream_code, cls.class_name, usr.admission_id, sec.section_name, evnt.event_name, evnt.event_desc
							FROM
								users usr, class cls, section sec, stream str, '.$table.' tb, events evnt
							WHERE
								tb.event_id = '.$eventId.'
							AND
								tb.user_id = usr.id
							AND
								usr.section = sec.id
							AND
								sec.class_id = cls.id
							AND
								usr.stream_id = str.id
							AND
								tb.event_id = evnt.id
							AND
								tb.status = 1';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET EVENT REGISTERED CANDIDATES 
	 */
	 public function getEventRegCand($table,$eventId){
			
			$sql		= 'SELECT
								usr.id, usr.firstname, usr.lastname, str.stream_code, cls.class_name, usr.admission_id, sec.section_name, evnt.event_name, evnt.event_desc
							FROM
								users usr, class cls, section sec, stream str, '.$table.' tb, events evnt
							WHERE
								tb.event_id = '.$eventId.'
							AND
								tb.user_id = usr.id
							AND
								usr.section = sec.id
							AND
								sec.class_id = cls.id
							AND
								usr.stream_id = str.id
							AND
								tb.event_id = evnt.id
							AND
								tb.status = 0';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  APPROVE USERS FOR EVENTS 
	 */
	 public function approveUserForEvent($table,$eventId,$userId){
			
			$sql		= 'UPDATE '.$table.' SET status = 1 WHERE event_id = '.$eventId.' AND user_id = '.$userId;

			$result		= $this->dbObj->executeQuery($sql);

			return $result;
	 } 	

	/*
	 *  GET EVENTS FOR RESULTS
	 */
	 public function getResultedEvents($table,$eventType){
			
			$today		= date('Y-m-d');
			
			$sql		= 'SELECT 
								id, event_name, is_registration, event_date, reg_frm_date, reg_to_date
						   FROM 
						   		'.$table.'
						   WHERE
						   		event_type_id = '.$eventType.'
							AND
								event_date <= "'.$today.'" ';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET EVENT RESULTS 
	 */
	 public function getEventResult($table,$eventId){
			
			$sql		= 'SELECT
								usr.id, usr.firstname, usr.lastname, cls.class_name, usr.admission_id, sec.section_name, evnt.event_name, evnt.event_desc, tb.award
							FROM
								users usr, class cls, section sec, '.$table.' tb, events evnt
							WHERE
								tb.event_id = '.$eventId.'
							AND
								tb.user_id = usr.id
							AND
								usr.section = sec.id
							AND
								sec.class_id = cls.id
							AND
								tb.event_id = evnt.id';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 
	 
	/*
	 *  ANNOUNCE EVENT RESULT 
	 */
	 public function eventResult($table,$userDet,$eventId){
			
			$userId		= $userDet['user_id'];
			$award		= $userDet['award'];
			
			$userRes	= $this->eventResultCheck($table,$userId,$eventId);
			
			$result	= 0;
			
			if(empty($userRes)){
				
				$sql		= 'INSERT INTO '.$table.' ( event_id, user_id, award ) VALUES ( '.$eventId.', '.$userId.', "'.$award.'" )';
	
				$result		= $this->dbObj->executeQuery($sql);
			}
			
			return $result;
	 } 
	 
	/*
	 *  CHECK EVENT RESULT 
	 */
	 public function eventResultCheck($table,$userId,$eventId){
			
			$sql		= 'SELECT event_id, user_id, award FROM '.$table.' WHERE user_id = '.$userId.' AND event_id = '.$eventId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 

	/*
	 *  DELETE EVENT
	 */
	 public function deleteEvent($table, $eventId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$eventId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  INSERT NEW SYLLABUS
	 */
	 public function addSyllabus($table, $varArray){
			
			$classId		= $varArray['class_id'];
			$sylName		= $varArray['syllabus_name'];

			$sqlQuery		= 'INSERT INTO '.$table.' ( syllabus_name, class_id)
							 	VALUES ( "'.$sylName.'" , "'.$classId.'" )';
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  UPDATE SYLLABUS
	 */
	 public function editSyllabus($table, $varArray){
			
			$classId		= $varArray['class_id'];
			$sylName		= $varArray['syllabus_name'];

			$sqlQuery		= 'UPDATE '.$table.' SET syllabus_name = "'.$sylName.'" WHERE class_id = "'.$classId.'"';
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  DELETE SYLLABUS
	 */
	 public function deleteSyllabus($table, $sylId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$sylId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET SYLLABUS FOR ID 
	 */
	 public function getSyllabusById($table,$sylId){
			
			$sql		= 'SELECT
								id, syllabus_name, class_id
							FROM
								'.$table.'
							WHERE
								id = '.$sylId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET SYLLABUS FOR CLASS 
	 */
	 public function getSyllabusForClass($table,$classId){
			
			$sql		= 'SELECT
								id, syllabus_name
							FROM
								'.$table.'
							WHERE
								class_id = '.$classId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 
	 
	/*
	 *  GET SUBJECTS FOR CLASS 
	 */
	 public function getSubjectsForClass($table,$classId){
			
			$sql		= 'SELECT
								id, sub_name, sub_code
							FROM
								'.$table.'
							WHERE
								class_id = '.$classId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET SUBJECT BY ID
	 */
	 public function getSubjectById($table,$subjId){
			
			$classTable = TB_CLASS;
			$sql		= 'SELECT 
								tb.id, tb.sub_code, tb.sub_name, cls.class_name, cls.class_code, cls.id class_id
						   FROM 
						   		'.$table.' tb
						   INNER JOIN
						   		'.$classTable.' cls
						   ON
						   		tb.class_id = cls.id
						   WHERE
								tb.id = '.intval($subjId);

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 
	
	/*
	 *  Add SUBJECT
	 */
	 public function addSubject($table,$varArray){

			$clsId		= $varArray['class_id'];
			$subCode	= $varArray['subj_code'];
			$subName	= $varArray['subj_name'];
			
			$sql		= 'INSERT INTO '.$table.' ( class_id, sub_code, sub_name ) VALUES ( "'.$clsId.'", "'.$subCode.'", "'.$subName.'" ) ';
			
			$result		= $this->dbObj->executeQuery($sql);
			
			return $result;
	 }	
	 
	/*
	 *  UPDATE SUBJECT
	 */
	 public function editSubject($table, $varArray){
			
			$classId		= $varArray['class_id'];
			$subjId			= $varArray['subj_id'];

			$subjName		= $varArray['subj_name'];
			$subjCode		= $varArray['subj_code'];

			$sqlQuery		= 'UPDATE '.$table.' SET class_id = "'.$classId.'", sub_code = "'.$subjCode.'", sub_name = "'.$subjName.'" WHERE id = '.$subjId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  DELETE SUBJECT
	 */
	 public function deleteSubject($table, $subjectId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$subjectId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET MATERIALS FOR SUBJECTS 
	 */
	 public function getMaterialsForSubj($table,$subjId){
			
			$sql		= 'SELECT
								id, material_name, mater_file
							FROM
								'.$table.'
							WHERE
								sub_id = '.$subjId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  GET MATERIALS 
	 */
	 public function getMaterialById($table,$materialId){
			
			$sql		= 'SELECT
								tb.id id, tb.material_name, tb.mater_file, cls.id class_id, sub.id subject_id, sub.sub_code
							FROM
								'.$table.' tb,
								 class cls,
								 subjects sub
							WHERE
								tb.id = '.$materialId.'
							AND
								tb.sub_id = sub.id
							AND
								sub.class_id = cls.id';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  INSERT NEW MATERIAL
	 */
	 public function addMaterial($table, $varArray){
			
			$classId		= $varArray['class_id'];
			$subjId			= $varArray['subj_id'];
			$materName		= $varArray['material_name'];
			$materFileName	= $varArray['material_file_name'];

			$sqlQuery		= 'INSERT INTO '.$table.' ( sub_id, material_name, mater_file)
							 	VALUES ( "'.$subjId.'" , "'.$materName.'", "'.$materFileName.'" )';
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  UPDATE MATERIAL
	 */
	 public function editMaterial($table, $varArray){
			
			$materialId		= $varArray['material_id'];
			
			$classId		= $varArray['class_id'];
			$subjId			= $varArray['subj_id'];
			$materName		= $varArray['material_name'];
			$materFileName	= $varArray['material_file_name'];

			$sqlQuery		= 'UPDATE '.$table.' SET sub_id = "'.$subjId.'" , material_name = "'.$materName.'" , mater_file = "'.$materFileName.'" WHERE id = '.$materialId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  DELETE MATERIAL
	 */
	 public function deleteMaterial($table, $materialId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$materialId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET PREVIOUS PAPERS FOR SUBJECTS 
	 */
	 public function getPrePapersForSubj($table,$subjId){
			
			$sql		= 'SELECT
								id, paper_name, paper_file
							FROM
								'.$table.'
							WHERE
								subj_id = '.$subjId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  INSERT NEW PAPER
	 */
	 public function addPaper($table, $varArray){
			
			$classId		= $varArray['class_id'];
			$subjId			= $varArray['subj_id'];
			$paperName		= $varArray['paper_name'];
			$paperFileName	= $varArray['paper_file_name'];

			$sqlQuery		= 'INSERT INTO '.$table.' ( subj_id, paper_name, paper_file)
							 	VALUES ( "'.$subjId.'" , "'.$paperName.'", "'.$paperFileName.'" )';
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET PAPER 
	 */
	 public function getPaperById($table,$paperId){
			
			$sql		= 'SELECT
								tb.id id, tb.paper_name	, tb.paper_file, cls.id class_id, sub.id subject_id, sub.sub_code
							FROM
								'.$table.' tb,
								 class cls,
								 subjects sub
							WHERE
								tb.id = '.$paperId.'
							AND
								tb.subj_id = sub.id
							AND
								sub.class_id = cls.id';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  UPDATE PAPER
	 */
	 public function editPaper($table, $varArray){
			
			$paperId		= $varArray['paper_id'];
			
			$classId		= $varArray['class_id'];
			$subjId			= $varArray['subj_id'];
			$paperName		= $varArray['paper_name'];
			$paperFileName	= $varArray['paper_file_name'];

			$sqlQuery		= 'UPDATE '.$table.' SET subj_id = "'.$subjId.'" , paper_name = "'.$paperName.'" , paper_file = "'.$paperFileName.'" WHERE id = '.$paperId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  DELETE PAPER
	 */
	 public function deletePaper($table, $paperId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$paperId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET ACHEIVEMENTS 
	 */
	 public function getAchievements($table, $categoty_id){
			
			$sql		= 'SELECT
								id, category_id, achievement_desc
							FROM
								'.$table.'
							WHERE
								category_id = '.$categoty_id;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  INSERT NEW ACHIEVEMENT
	 */
	 public function addAchievement($table, $varArray){
			
			$typeId			= $varArray['typeId'];
			$achieveDesc	= $varArray['achievement_desc'];

			$sqlQuery		= 'INSERT INTO '.$table.' ( category_id, achievement_desc )
							 	VALUES ( "'.$typeId.'" , "'.$achieveDesc.'" )';
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET ACHEIVEMENTS BY ID
	 */
	 public function getAchievementsByid($table, $id){
			
			$sql		= 'SELECT
								id, category_id, achievement_desc
							FROM
								'.$table.'
							WHERE
								id = '.$id;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 

	/*
	 *  DELETE ACHIEVEMENT
	 */
	 public function deleteAchievement($table, $achieveId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$achieveId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET PLACEMENTS 
	 */
	 public function getPlacements($table, $categoty_id){
			
			$sql		= 'SELECT
								id, placement_desc
							FROM
								'.$table.'
							WHERE
								category_id = '.$categoty_id;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  INSERT NEW PLACEMENT
	 */
	 public function addPlacement($table, $varArray){
			
			$typeId			= $varArray['typeId'];
			$placementDesc	= $varArray['placement_desc'];

			$sqlQuery		= 'INSERT INTO '.$table.' ( category_id, placement_desc )
							 	VALUES ( "'.$typeId.'" , "'.$placementDesc.'" )';
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  DELETE PLACEMENT
	 */
	 public function deletePlacement($table, $placementId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$placementId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET ALUMNI
	 */
	 public function getAlumniDet($table, $categoty_id){
			
			$sql		= 'SELECT
								id, alumni_desc
							FROM
								'.$table.'
							WHERE
								category_id = '.$categoty_id;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 
	
	/*
	 *  GET ALUMNI BY BATCH
	 */
	 public function getAlumniDetails($table, $batchId){
			
			$sql		= 'SELECT
								id, alumni_desc, alumni_img
							FROM
								'.$table.'
							WHERE
								batch_id = '.$batchId;

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 

	/*
	 *  INSERT NEW ALUMNI
	 */
	 public function addAlumni($table, $varArray){
			
			$typeId			= $varArray['typeId'];
			$alumniDesc		= $varArray['alumni_desc'];

			$sqlQuery		= 'INSERT INTO '.$table.' ( category_id, alumni_desc )
							 	VALUES ( "'.$typeId.'" , "'.$alumniDesc.'" )';
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  INSERT NEW ALUMNI DETAILS
	 */
	 public function addAlumniDetails($table, $varArray){
			
			$batchId		= $varArray['typeId'];
			$alumniDesc		= $varArray['alumni_desc'];
			$alumniImage	= $varArray['image'];

			$sqlQuery		= 'INSERT INTO '.$table.' ( batch_id, alumni_desc, alumni_img )
							 	VALUES ( "'.$batchId.'" , "'.$alumniDesc.'" , "'.$alumniImage.'" )';
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  DELETE ALUMNI
	 */
	 public function deleteAlumni($table, $alumniId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$alumniId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  GET COMMENTS 
	 */
	 public function getComment($table, $type){
			
			$sql		= 'SELECT
								id, name, qualification, designation, comment, image
							FROM
								'.$table.'
							WHERE
								type = "'.$type.'"';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 	 
	
	/*
	 *  GET USERS BY SECTION ID 
	 */
	 public function getUsersBySecId($table, $sectionId){
			
			$sqlQuery	= 'SELECT id, username, password, firstname, mail_id, admission_id, image, status FROM '.$table.' WHERE section = "'.$sectionId.'" AND status = 1';

			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	}
	
	
	/*
	 *  ASSIGN USERS AS WISE COMMITTEE MEMBERS
	 */
	 public function addCommitteeMember($table, $varArray){
			$this->ensureCommitteeMemberColumns($table);
			
			$cmtCatId		= (int)$varArray['committee_cat_id'];
			$userId			= isset($varArray['user_id']) ? (int)$varArray['user_id'] : 0;
			$memberName		= isset($varArray['member_name']) ? addslashes((string)$varArray['member_name']) : '';
			$memberAbout	= isset($varArray['member_about']) ? addslashes((string)$varArray['member_about']) : '';
			$memberImage	= isset($varArray['member_image']) ? addslashes((string)$varArray['member_image']) : '';
			
			$msg	= '';
			
			$isCommitMem	= $this->getCmtMembers($table,$cmtCatId);
			
			if( !empty( $isCommitMem ) ){

				$sql		= 'UPDATE '.$table.' 
							SET user_id = '.$userId.',
								member_name = "'.$memberName.'",
								member_about = "'.$memberAbout.'",
								member_image = "'.$memberImage.'"
							WHERE committee_cat_id = '.$cmtCatId;

				$addCmtMem	= $this->dbObj->executeQuery($sql);

				if( $addCmtMem	){
					$msg		= 'Successfully Added';
				}else{
					$msg		= 'Sorry, Please Try Again';
				}
			}else{
				
				$sql		= 'INSERT INTO '.$table.' ( committee_cat_id , user_id, member_name, member_about, member_image ) 
							values ('.$cmtCatId.' , '.$userId.', "'.$memberName.'", "'.$memberAbout.'", "'.$memberImage.'" )';
					
				$addCmtMem	= $this->dbObj->executeQuery($sql);
				
				if( $addCmtMem	){
					$msg		= 'Successfully Added';
				}else{
					$msg		= 'Sorry, Please Try Again';
				}
			}
			
			return $msg;
	}
	
	/*
	 *  GET EVENT TYPES
	 */
	 public function getEventTypes($table){
			
			$sqlQuery	= 'SELECT id, event_type FROM '.$table;

			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	}
	
	/*
	 *  GET NEW EVENT
	 */
	 public function addNewEvent($table, $varArray){
			
			$eventTypeId		= $varArray['event_type_id'];
			$eventName			= $varArray['event_name'];
			$eventDesc			= $varArray['event_desc'];
			$eventAddress		= $varArray['event_address'];
			$eventDate			= $varArray['event_date'];
			$eventRegStartDate	= $varArray['reg_frm_date'];
			$eventRegEndDate	= $varArray['reg_to_date'];
			$isReg				= $varArray['is_registration'];
			
			$sqlQuery	= 'INSERT INTO '.$table.' ( event_type_id, event_name, event_desc, event_address, event_date, reg_frm_date, reg_to_date , is_registration)
							 VALUES ( "'.$eventTypeId.'" , "'.$eventName.'" , "'.$eventDesc.'" , "'.$eventAddress.'", "'.$eventDate.'", "'.$eventRegStartDate.'", "'.$eventRegEndDate.'", "'.$isReg.'" )';
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}
	
	/*
	 *  CHECK COMMENT IS EXIST 
	 */
	 public function checkComments($table,$comType){
			
			
			$sql		= 'SELECT id, name, qualification, designation, comment 
							FROM '.$table.' 
							WHERE type = "'.$comType.'"';

			$result		= $this->dbObj->getAllResults($sql);

			return $result;
	 } 

	/*
	 *  CHANGE COMMENTS 
	 */
	 public function changeComments($table,$varArray){
			
			$comType	= $varArray['comType'];
			$comName	= $varArray['comName'];
			$comQualif	= $varArray['comQualif'];
			$comDesig	= $varArray['comDesig'];
			$comComment	= $varArray['comComment'];
			
			$image		= $varArray['image'];
			
			$checkCmt	= $this->checkComments ( $table, $comType );
			
			if( !empty( $checkCmt ) ){
				$sql		= 'UPDATE '.$table.' SET name = "'.$comName.'", qualification = "'.$comQualif.'", designation = "'.$comDesig.'", comment = "'.$comComment.'", image =  "'.$image.'" WHERE type = "'.$comType.'"';
			}else{
				$sql		= 'INSERT INTO '.$table.' (name , type, qualification , designation, comment, image ) VALUES("'.$comName.'", "'.$comType.'", "'.$comQualif.'", "'.$comDesig.'", "'.$comComment.'", "'.$image.'" )';
			}

			$result		= $this->dbObj->executeQuery($sql);

			return $result;
	 } 
	 
	/*
	 *  GET HIGH LIGHTS
	 */
	 public function getHighLights($table, $type){
			
			$sqlQuery	= 'SELECT id, type, high_light FROM '.$table.' WHERE type = '.$type.' ORDER BY id DESC';

			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	}
	
	/*
	 *  ADD HIGH LIGHTS
	 */
	 public function addHighLight($table, $varArray){
			
			$typeId		= $varArray['typeId'];
			$highLight	= $varArray['highLight'];
			
			$sqlQuery	= 'INSERT INTO '.$table.' ( type, high_light ) VALUES ('.$typeId.', "'.$highLight.'")';

			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	/*
	 *  DELETE HIGH LIGHT
	 */
	 public function deleteHighLight($table, $highLightId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$highLightId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}


	/*
	 *  EVENTS FOR GALLERY
	 */
	 public function getEventGallery($table){
			
			$sqlQuery	= 'SELECT
								DISTINCT(evt.id) AS id, evt.event_name, evt.event_desc
							FROM
								events evt, '.$table.' tb
							WHERE
								evt.id = tb.event_id';
			
			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	}
	 	
	/*
	 *  GET IMAGES FOR EVENT
	 */
	 public function getImagesForEvents($table,$eventId){
			
			$sqlQuery	= 'SELECT
								tb.name, tb.id , tb.description, tb.image_name
							FROM
								'.$table.' tb
							WHERE
								tb.event_id = '.$eventId.'
							ORDER BY 
								tb.id DESC';
			
			$result		= $this->dbObj->getAllResults($sqlQuery);
			
			return $result;
	}

	/*
	 *  ADD GALLERY 
	 */
	 public function addGallery($table,$varArray){
			
			$eventId	= $varArray['event_id'];
			$imgName	= $varArray['image_name'];
			$imgDesc	= $varArray['image_desc'];
			$imgLink	= $varArray['image'];

			$sql		= 'INSERT INTO '.$table.' ( event_id, name, description, image_name ) VALUES ( '.$eventId.', "'.$imgName.'", "'.$imgDesc.'", "'.$imgLink.'" )';

			$result		= $this->dbObj->executeQuery($sql);
			
			return $result;
	 }	 	
	 
	/*
	 *  DELETE GALLERY
	 */
	 public function deleteGallery($table, $imageId){
			
			$sqlQuery	= 'DELETE FROM '.$table.' WHERE id = '.$imageId;
			
			$result		= $this->dbObj->executeQuery($sqlQuery);
			
			return $result;
	}

	
	




    /*
     *  GET TOTAL COUNT FROM ANY TABLE
     */
    public function getCount($table){
        
        $sqlQuery = "SELECT COUNT(*) AS total FROM ".$table;
        $result   = $this->dbObj->getAllResults($sqlQuery);

        if(!empty($result)){
            return $result[0]['total'];
        }else{
            return 0;
        }
    }


    /*
     *  GET LATEST ACTIVITIES (FOR DASHBOARD)
     */
    public function getLatestActivities($table = 'activities'){
        
        $sqlQuery = "SELECT id, title, created_at 
                     FROM ".$table." 
                     ORDER BY created_at DESC 
                     LIMIT 5";

        try {
            $result = $this->dbObj->getAllResults($sqlQuery);
            return $result;
        } catch (Exception $e) {
            // Keep dashboard functional when optional activity table is absent.
            return array();
        }
    }

    /*
     *  GET UPCOMING EVENTS (FOR DASHBOARD)
     */
    public function getUpcomingEvents($limit = 5, $table = 'events'){

        $limit = (int)$limit;
        if($limit <= 0){
            $limit = 5;
        }

        $today = date('Y-m-d');

        $sqlQuery = "SELECT id, event_name, event_date
                     FROM ".$table."
                     WHERE event_date >= '".$today."'
                     ORDER BY event_date ASC
                     LIMIT ".$limit;

        try {
            return $this->dbObj->getAllResults($sqlQuery);
        } catch (Exception $e) {
            return array();
        }
    }

    /*
     *  GET ENROLLMENT BY BATCH (FOR DASHBOARD)
     */
    public function getEnrollmentByBatch($limit = 4){

        $limit = (int)$limit;
        if($limit <= 0){
            $limit = 4;
        }

        $sqlQuery = "SELECT yb.id AS batch_id, yb.batch AS batch_name, COUNT(u.id) AS total
                     FROM year_batch yb
                     LEFT JOIN users u ON u.batch_id = yb.id
                     GROUP BY yb.id, yb.batch
                     ORDER BY yb.id DESC
                     LIMIT ".$limit;

        try {
            return $this->dbObj->getAllResults($sqlQuery);
        } catch (Exception $e) {
            return array();
        }
    }



}


