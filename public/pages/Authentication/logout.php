<?php
session_start();
require_once(__DIR__ . '/../../../config.php');

/* Decide redirect before destroying session */
$redirectPage = BASE_URL . "/public/pages/authentication/login.php";

if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] == "admin") {
        $redirectPage = BASE_URL . "/public/pages/authentication/login.php";
    } else {
        $redirectPage = BASE_URL . "/public/pages/authentication/login.php";
    }
}

/* Unset all session variables */
$_SESSION = array();

/* Destroy session */
session_destroy();

/* Destroy session cookie (important for security) */
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

/* Redirect */
header("Location: " . $redirectPage);
exit;
?>
