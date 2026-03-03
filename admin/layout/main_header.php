<?php
if (session_id() == '') {
    session_start();
}

if (!isset($_SESSION['adminId'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | AIML Department</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        body {
            overflow-x: hidden;
            background: #f5f7fa;
        }

        .sidebar {
            height: 100vh;
            background: #1f2937;
            color: #fff;
            position: fixed;
            width: 240px;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #374151;
            color: #fff;
        }

        .content-area {
            margin-left: 240px;
            padding: 25px;
        }

        .topbar {
            background: #ffffff;
            padding: 15px 25px;
            border-bottom: 1px solid #e5e7eb;
            margin-left: 240px;
        }

        .admin-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h5 class="text-center py-4 border-bottom">AIML Admin</h5>

    <a href="/department/admin/main_home.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="/department/admin/committe/assoc.php"><i class="bi bi-building me-2"></i> Assoc Name</a>
    <a href="/department/admin/department/department.php"><i class="bi bi-mortarboard me-2"></i> Department</a>
    <a href="/department/admin/users/users.php"><i class="bi bi-people me-2"></i> Users</a>
    <a href="/department/admin/gallery/gallery.php"><i class="bi bi-images me-2"></i> Gallery</a>
    <a href="/department/admin/sliderimages.php"><i class="bi bi-sliders me-2"></i> Slider Images</a>
    <a href="/department/admin/settings/otheroperations.php"><i class="bi bi-gear me-2"></i> Core Settings</a>

    <hr class="bg-secondary">

    <a href="/department/admin/settings/changepassword.php"><i class="bi bi-key me-2"></i> Change Password</a>
    <a href="/department/admin/logout.php" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
</div>

<!-- Topbar -->
<div class="topbar d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Welcome, <?php echo $_SESSION['adminFirstName'] ?? 'Admin'; ?>!</h5>

    <div class="d-flex align-items-center gap-3">
        <?php
            $adminImageFile = basename($_SESSION['adminImage'] ?? '');
            $defaultAdminImage = 'ithod.png';
            $adminImageWebPath = '/department/public/assets/images/admin/' . ($adminImageFile !== '' ? $adminImageFile : $defaultAdminImage);
            $adminImageDiskPath = __DIR__ . '/../../public/assets/images/admin/' . ($adminImageFile !== '' ? $adminImageFile : $defaultAdminImage);

            if (!file_exists($adminImageDiskPath)) {
                $adminImageWebPath = '/department/public/assets/images/admin/' . $defaultAdminImage;
            }
        ?>
        <img
            src="<?php echo htmlspecialchars($adminImageWebPath, ENT_QUOTES, 'UTF-8'); ?>"
            class="admin-img"
            alt="Admin"
        >
    </div>
</div>

<!-- Content Wrapper -->
<div class="content-area">
