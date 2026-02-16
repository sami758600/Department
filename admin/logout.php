/* <?php
	
   session_start();
	
   unset($_SESSION['adminId']);
   unset($_SESSION['adminName']);
   unset($_SESSION['adminFirstName']);
   unset($_SESSION['adminImage']);
   
   header('Location: index.php');

?> */

<?php
session_start();
require_once(__DIR__ . '/../config.php');

/* Destroy session */
$_SESSION = array();
session_destroy();

/* Redirect to login page */
header("Location: " . BASE_URL . "/index.php");
exit;
?>
