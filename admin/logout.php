<?php
	
   session_start();
	
   unset($_SESSION['adminId']);
   unset($_SESSION['adminName']);
   unset($_SESSION['adminFirstName']);
   unset($_SESSION['adminImage']);
   
   header('Location: index.php');

?>