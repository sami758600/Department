<?php
if (session_id() == '') {
    session_start();
}

require_once(__DIR__ . '/../../../config.php');
require_once(LIB_PATH . '/functions.class.php');

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
            'image'         => $fileName,
            'status'        => 'active'   // ADD THIS
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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/register.css">

    
</head>

<body>

<div class="register-layout">

    <!-- LEFT SIDE -->
    <div class="left-panel">
        <div class="brand">MBA Department</div>

        <div class="left-content">
            <h1>Empower Your Future with <span>Intelligent Learning</span></h1>
            <p>
                Access academic resources, structured programs and 
                advanced learning tools designed for tomorrow’s leaders.
            </p>

            <div class="stats">
                <div><strong>10K+</strong><span>Active Students</span></div>
                <div><strong>450+</strong><span>Courses</span></div>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right-panel">

        <div class="form-card">

            <h4>Registration</h4>
            <p class="subtitle">Please fill in all details to complete your enrollment.</p>

            <?php if (isset($_SESSION['err_msg'])) { ?>
                <div class="alert alert-danger text-center">
                    <?php echo $_SESSION['err_msg']; unset($_SESSION['err_msg']); ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data">

                <!-- Account -->
                <div class="form-section">
                    <h6>Account Information</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="uname" class="form-control modern-input" placeholder="Username" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="admissionId" class="form-control modern-input" placeholder="Admission ID" required>
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="pword" class="form-control modern-input" placeholder="Password" required>
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="confirmpassword" class="form-control modern-input" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>

                <!-- Personal -->
                <div class="form-section">
                    <h6>Personal Information</h6>
                    <div class="row g-3">

                        <!-- First Name -->
                        <div class="col-md-4">
                            <input type="text" name="firstname" 
                                class="form-control modern-input" 
                                placeholder="First Name" required>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-4">
                            <input type="text" name="lastname" 
                                class="form-control modern-input" 
                                placeholder="Last Name" required>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-4">
                            <select name="gender" 
                                    class="form-select modern-input" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <input type="email" name="email" 
                                class="form-control modern-input" 
                                placeholder="Email Address" required>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <input type="text" name="phone" 
                                class="form-control modern-input" 
                                placeholder="Phone Number" required>
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <input type="text" name="address" 
                                class="form-control modern-input" 
                                placeholder="Home Address" required>
                        </div>

                    </div>
                </div>


                <!-- Academic -->
                <div class="form-section">
                    <h6>Academic Information</h6>
                    <div class="row g-3">

                        <!-- Batch -->
                        <div class="col-md-3">
                            <select name="batchId" class="form-select modern-input" required>
                                <option value="">Academic Batch</option>
                                <?php foreach ($batches as $b) { ?>
                                    <option value="<?= $b['id']; ?>"><?= $b['batch']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Stream -->
                        <div class="col-md-3">
                            <select name="streamId" class="form-select modern-input" required>
                                <option value="">Study Stream</option>
                                <?php foreach ($streams as $s) { ?>
                                    <option value="<?= $s['id']; ?>"><?= $s['stream_code']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Class -->
                        <div class="col-md-3">
                            <select name="classId" class="form-select modern-input" required>
                                <option value="">Assigned Class</option>
                                <?php foreach ($classes as $c) { ?>
                                    <option value="<?= $c['id']; ?>"><?= $c['class_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Section -->
                        <div class="col-md-3">
                            <input type="text" name="sectionId" 
                                class="form-control modern-input" 
                                placeholder="Section" required>
                        </div>

                    </div>
                </div>


                <!-- Upload -->
                <div class="form-section">
                    <h6>Profile Photo</h6>
                    <input type="file" name="usrImage" class="form-control modern-input">
                </div>

                <button type="submit" name="submit" class="btn create-btn w-100 mt-4">
                    Create My Account
                </button>

            </form>

        </div>

    </div>

</div>

</body>




</html>
