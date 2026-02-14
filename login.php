<?php
if (session_id() == '') {
    session_start();
}

require_once("libraries/functions.class.php");

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
            header('Location: login.php');
            exit;
        }

        $_SESSION['role']      = "user";
        $_SESSION['userId']    = $userDet[0]['id'];
        $_SESSION['userName']  = $uName;
        $_SESSION['firstName'] = $userDet[0]['firstname'];
        $_SESSION['image']     = $userDet[0]['image'];

        header('Location: index.php');
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
            header('Location: login.php');
            exit;
        }

        $_SESSION['role']       = "admin";
        $_SESSION['adminId']    = $adminDet[0]['id'];
        $_SESSION['adminName']  = $adminDet[0]['adminname'];
       $_SESSION['adminFirstName'] = $adminDet[0]['firstname'];
        $_SESSION['image']      = $adminDet[0]['image'];

        header('Location: admin/index.php'); // make sure this folder exists
        exit;
    }
}

/* Redirect if already logged in */
if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] == "admin") {
        header('Location: admin/index.php');
    } else {
        header('Location: index.php');
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | MBA Department</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: url('images/hero-bg.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
        }

        .login-card {
            position: relative;
            width: 100%;
            max-width: 420px;
            border-radius: 16px;
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .login-title {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: none;
            color: white;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-user {
            background: #ffc107;
            border: none;
            font-weight: 600;
        }

        .btn-user:hover {
            background: #ffb300;
        }

        .btn-admin {
            background: #212529;
            border: none;
            font-weight: 600;
        }

        .btn-admin:hover {
            background: #000;
        }

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 38px;
            color: #ccc;
        }

        .position-relative {
            position: relative;
        }
    </style>
</head>

<body>

<div class="card login-card shadow-lg border-0 p-4">

    <h4 class="text-center login-title mb-2">
        MBA Department
    </h4>

    <p class="text-center mb-4 text-light">
        Sign in to continue
    </p>

    <?php if (isset($_SESSION['err_msg'])) { ?>
        <div class="alert alert-danger text-center">
            <?php
                echo $_SESSION['err_msg'];
                unset($_SESSION['err_msg']);
            ?>
        </div>
    <?php } ?>

    <form method="POST" action="login.php">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>

        <div class="mb-3 position-relative">
            <label class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <span class="toggle-password" onclick="togglePassword()">👁</span>
        </div>

        <div class="d-grid gap-2 mt-4">
            <button type="submit" name="login_type" value="user" class="btn btn-user btn-lg">
                User Login
            </button>

            <button type="submit" name="login_type" value="admin" class="btn btn-admin btn-lg">
                Admin Login
            </button>
        </div>

    </form>

</div>

<script>
function togglePassword() {
    const pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

</body>
</html>
