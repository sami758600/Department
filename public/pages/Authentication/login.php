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
            header("Location: " . BASE_URL . "/public/pages/login.php");
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
            header("Location: " . BASE_URL . "/public/pages/login.php");
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
<title>Login | MBA Department</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/login.css">

</head>

<body>

<div class="login-wrapper">

    <!-- LEFT SIDE -->
    <div class="left-panel">
        <div class="brand">MBA Department</div>

        <div class="left-content">
            <h1>Department Portal</h1>
            <p>
                Secure access for students and administrators to manage
                academic resources, placements, events and departmental data.
            </p>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right-panel">

        <div class="login-card">

            <h3>Sign in</h3>
            <p>Enter your credentials to access the dashboard</p>

            <?php if (isset($_SESSION['err_msg'])) { ?>
                <div class="alert alert-danger">
                    <?php
                        echo $_SESSION['err_msg'];
                        unset($_SESSION['err_msg']);
                    ?>
                </div>
            <?php } ?>

            <form method="POST" action="login.php">

                <div class="mb-3">
                    <label>Email or Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3 input-group-custom">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <span class="toggle-password" onclick="togglePassword()">👁</span>
                </div>


                <div class="d-grid gap-2 mt-3">
                    <button type="submit" name="login_type" value="user" class="btn btn-user">
                        User Login
                    </button>

                    <button type="submit" name="login_type" value="admin" class="btn btn-admin">
                        Admin Login
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<script>
function togglePassword() {
    const pass = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");

    if (pass.type === "password") {
        pass.type = "text";
        icon.textContent = "🙈";
    } else {
        pass.type = "password";
        icon.textContent = "👁";
    }
}
</script>


</body>
</html>
