<?php
session_start();
require_once(__DIR__ . '/../../config.php');
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();
$tbUsers = TB_USERS;

$users = $_POST['users'];
$noOfUsers = sizeof($users);

for($i=0; $i<$noOfUsers; $i++){

    $userId = $users[$i];

    if(isset($_POST['approveusers'])){
        $fcObj->approveUser($tbUsers, $userId);
    }

    if(isset($_POST['deleteusers'])){
        $fcObj->deleteUser($tbUsers, $userId);
    }
}

header("Location: users.php");
exit;
?>
