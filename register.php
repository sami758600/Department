<?php
if (session_id() == '') {
    session_start();
}

require_once("libraries/functions.class.php");

$fcObj = new DataFunctions();

$tbBatch  = TB_BATCH;
$tbStream = TB_STREAM;
$tbClass  = TB_CLASS;

$batches = $fcObj->getBatches($tbBatch);
$streams = $fcObj->getStreams($tbStream);
$classes = $fcObj->getClasses($tbClass);

/* --------- REDIRECT IF LOGGED IN --------- */
if (isset($_SESSION['userName'])) {
    header('Location: index.php');
    exit;
}

/* --------- FORM SUBMIT --------- */
if (isset($_POST['submit'])) {

    $uName       = $_POST['uname'];
    $pass        = $_POST['pword'];
    $cPass       = $_POST['confirmpassword'];
    $fName       = $_POST['firstname'];
    $lName       = $_POST['lastname'];
    $gender      = $_POST['gender'];
    $email       = $_POST['email'];
    $address     = $_POST['address'];
    $phone       = $_POST['phone'];
    $class       = $_POST['classId'];
    $batchId     = $_POST['batchId'];
    $streamId    = $_POST['streamId'];
    $section     = $_POST['sectionId'];
    $admissionId = $_POST['admissionId'];

    if ($pass !== $cPass) {
        $_SESSION['err_msg'] = 'Passwords do not match';
    } else {

        $fileName = '';
        if (!empty($_FILES['usrImage']['name'])) {
            $fileName = 'user_' . $admissionId . '.png';
            move_uploaded_file($_FILES['usrImage']['tmp_name'], "images/users/" . $fileName);
        }

        $varArray = [
            'username'      => $uName,
            'password'      => sha1($pass),
            'mail_id'       => $email,
            'firstname'     => $fName,
            'lastname'      => $lName,
            'gender'        => $gender,
            'address'       => $address,
            'mobile_no'     => $phone,
            'batch_id'      => $batchId,
            'stream_id'     => $streamId,
            'section'       => $section,
            'admission_id'  => $admissionId,
            'image'         => $fileName
        ];

        $tbUser = TB_USERS;
        $register = $fcObj->regUser($tbUser, $varArray);

        if ($register == 1) {
            $_SESSION['success_msg'] = 'Registration successful. Please login.';
            header('Location: login.php');
            exit;
        } else {
            $_SESSION['err_msg'] = 'Registration failed. Try another username.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | MBA Department</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-card {
            max-width: 800px;
            width: 100%;
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="card register-card shadow-lg border-0">
    <div class="card-body p-4">

        <h4 class="text-center mb-4">Student Registration</h4>

        <?php if (isset($_SESSION['err_msg'])) { ?>
            <div class="alert alert-danger text-center">
                <?php echo $_SESSION['err_msg']; unset($_SESSION['err_msg']); ?>
            </div>
        <?php } ?>

        <form method="POST" enctype="multipart/form-data" class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Username</label>
                <input type="text" name="uname" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Admission ID</label>
                <input type="text" name="admissionId" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password" name="pword" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" name="firstname" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" name="lastname" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="col-md-12">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Batch</label>
                <select name="batchId" class="form-select">
                    <option value="">Select</option>
                    <?php foreach ($batches as $b) { ?>
                        <option value="<?= $b['id']; ?>"><?= $b['batch']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Stream</label>
                <select name="streamId" class="form-select">
                    <option value="">Select</option>
                    <?php foreach ($streams as $s) { ?>
                        <option value="<?= $s['id']; ?>"><?= $s['stream_code']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Class</label>
                <select name="classId" id="classId" class="form-select">
                    <option value="">Select</option>
                    <?php foreach ($classes as $c) { ?>
                        <option value="<?= $c['id']; ?>"><?= $c['class_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Profile Image</label>
                <input type="file" name="usrImage" class="form-control">
            </div>

            <div class="col-12 d-grid mt-3">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">
                    Register
                </button>
            </div>

        </form>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $('#classId').change(function () {
        $('#section').load('section.php?classId=' + $(this).val());
    });
</script>

</body>
</html>
