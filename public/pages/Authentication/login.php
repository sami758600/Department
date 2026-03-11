<?php
if (session_id() == '') {
    session_start();
}
require_once(__DIR__ . '/../../../config.php');

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

/* ---------- LOGIN LOGIC ---------- */
if (isset($_POST['username'])) {

    $uName = trim($_POST['username']);
    $pass  = trim($_POST['password']);
    $type  = $_POST['login_type'];

    /* ---------- USER LOGIN ---------- */
    if ($type == "user") {

        $tbUser  = TB_USERS;
        $userDet = $fcObj->userCheck($tbUser, $uName);

        if (
            empty($userDet) ||
            sha1($pass) != $userDet[0]['password'] ||
            $userDet[0]['status'] != 1
        ) {
            $_SESSION['err_msg'] = 'Invalid User Credentials';
            header("Location: " . BASE_URL . "/public/pages/Authentication/login.php");
            exit;
        }

        $_SESSION['role']      = "user";
        $_SESSION['userId']    = $userDet[0]['id'];
        $_SESSION['userName']  = $uName;
        $_SESSION['firstName'] = $userDet[0]['firstname'];
        $_SESSION['image']     = $userDet[0]['image'];

        header("Location: " . BASE_URL . "/public/pages/user/dashboard.php");
        exit;
    }

    /* ---------- ADMIN LOGIN ---------- */
    if ($type == "admin") {

        $tbAdmin  = "admin";
        $adminDet = $fcObj->adminLogin($tbAdmin, $uName);

        if (
            empty($adminDet) ||
            sha1($pass) != $adminDet[0]['password']
        ) {
            $_SESSION['err_msg'] = 'Invalid Admin Credentials';
            header("Location: " . BASE_URL . "/public/pages/Authentication/login.php");
            exit;
        }

        $_SESSION['role']           = "admin";
        $_SESSION['adminId']        = $adminDet[0]['id'];
        $_SESSION['adminName']      = $adminDet[0]['adminname'];
        $_SESSION['adminFirstName'] = $adminDet[0]['firstname'];
        $_SESSION['image']          = $adminDet[0]['image'];

        header("Location: " . BASE_URL . "/admin/index.php");
        exit;
    }
}

/* Redirect if already logged in */
if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] == "admin") {
    header("Location: " . BASE_URL . "/admin/index.php");
    } else {
    header("Location: " . BASE_URL . "/public/pages/user/dashboard.php");
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | AIML Department</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/login.css">

</head>

<body>

<div class="auth-shell">
    <div class="auth-frame">
        <header class="auth-header">
            <div class="brand-mark">AIML Department</div>
            <div class="auth-switch" role="tablist" aria-label="Authentication pages">
                <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/register.php" class="switch-link">Sign up</a>
                <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/login.php" class="switch-link active" aria-current="page">Login</a>
            </div>
        </header>

        <main class="auth-panel">
            <div class="auth-copy">
                <h2 class="auth-title">Log in to your existing profile</h2>
            </div>

            <?php if (isset($_SESSION['success_msg'])) { ?>
                <div class="alert alert-success">
                    <?php
                        echo $_SESSION['success_msg'];
                        unset($_SESSION['success_msg']);
                    ?>
                </div>
            <?php } ?>

            <?php if (isset($_SESSION['err_msg'])) { ?>
                <div class="alert alert-danger">
                    <?php
                        echo $_SESSION['err_msg'];
                        unset($_SESSION['err_msg']);
                    ?>
                </div>
            <?php } ?>

            <form method="POST" action="login.php" class="auth-form">
                <div class="field-group">
                    <input type="text" name="username" id="username" class="form-control auth-input" autocomplete="username" placeholder="Username or Email" required>
                </div>

                <div class="field-group">
                    <div class="password-wrap">
                        <input type="password" name="password" id="password" class="form-control auth-input" autocomplete="current-password" placeholder="Password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">Show</button>
                    </div>
                </div>

                <div class="role-actions">
                    <button type="submit" name="login_type" value="user" class="btn auth-btn primary-btn">
                        Login
                    </button>
                    <button type="submit" name="login_type" value="admin" class="btn auth-btn secondary-btn">
                        Admin Login
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
function togglePassword() {
    const pass = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");

    if (pass.type === "password") {
        pass.type = "text";
        icon.textContent = "Hide";
    } else {
        pass.type = "password";
        icon.textContent = "Show";
    }
}

document.querySelectorAll(".switch-link").forEach((link) => {
    link.addEventListener("click", (event) => {
        const target = link.getAttribute("href");
        if (!target || target === window.location.href) {
            return;
        }

        event.preventDefault();

        const navigate = () => {
            window.location.href = target;
        };

        if (document.startViewTransition) {
            document.startViewTransition(() => {
                navigate();
            });
            return;
        }

        document.body.classList.add("is-switching");
        window.setTimeout(navigate, 220);
    });
});
</script>


</body>
</html>
