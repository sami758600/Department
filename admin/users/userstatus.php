<?php 
	
   require_once("../libraries/functions.class.php") ;

   $fcObj	= new DataFunctions();

   $tbUsers		= TB_USERS;

   $users		= $_POST['users'];	
	
   $noOfUsers	= sizeof($users);
   	
   for($i=0;$i<$noOfUsers;$i++){
	   
	   $userId	= $users[$i];
	   
	   if ( isset ( $_POST['approveusers'] ) ){
					
			$aprUser[]	= $fcObj->approveUser ( $tbUsers, $userId );
		
	   }
	   if ( isset ( $_POST['deleteusers'] ) ){
					
			$delUser[]	= $fcObj->deleteUser ( $tbUsers, $userId );
		
	   }
	}
	
	if( isset( $_POST['classId'] ) ){
		header('Location: view_users.php');
		return false;
	}else{
		header('Location: users.php');
		return false;
	}
	include_once('header.php');

	/*if( $addAlumni ){
				
		header('Location: alumni.php');
		return false;
	}else{
		$msg	= 'Sorry, Please try again';
	}*/
?>
