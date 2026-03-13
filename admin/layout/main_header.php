<?php
if (session_id() == '') {
    session_start();
}

if (!defined('BASE_URL')) {
    require_once(__DIR__ . '/../../config.php');
}

if (!isset($_SESSION['adminId'])) {
    header('Location: ' . BASE_URL . '/admin/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel | AIML Department</title>
    <script>
        (function () {
            try {
                var savedTheme = localStorage.getItem('admin-theme');
                if (!savedTheme) {
                    savedTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                document.documentElement.setAttribute('data-theme', savedTheme);
            } catch (e) {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })();
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/site-refresh.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/admin-refresh.css">


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
            transition: transform 0.25s ease;
            z-index: 1040;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            border-left: 3px solid transparent;
            transition: background-color 0.25s ease, color 0.25s ease, transform 0.25s ease, border-left-color 0.25s ease;
        }

        .sidebar a:hover {
            background: #2f3b4d;
            color: #fff;
            transform: translateX(4px);
            border-left-color: #60a5fa;
        }

        .sidebar a i {
            width: 18px;
            text-align: center;
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }

        .sidebar a:hover i {
            transform: scale(1.08);
        }

        .sidebar a.text-danger {
            color: #f87171 !important;
        }

        .sidebar a.text-danger:hover {
            color: #fff !important;
            background: #7f1d1d;
            border-left-color: #f87171;
        }

        .sidebar-brand {
            color: #f8fbff !important;
            background: rgba(255, 255, 255, 0.08);
            margin: 10px 14px 14px;
            padding: 12px 10px !important;
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 12px;
            font-weight: 800;
            letter-spacing: 0.4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.35);
        }

        .content-area {
            margin-left: 240px;
            padding: 25px;
            transition: margin-left 0.25s ease;
        }

        .topbar {
            background: #ffffff;
            padding: 15px 25px;
            border-bottom: 1px solid #e5e7eb;
            margin-left: 240px;
            transition: margin-left 0.25s ease;
        }

        .topbar-primary,
        .topbar-actions {
            min-width: 0;
        }

        .topbar-title {
            font-size: 1.15rem;
            line-height: 1.3;
            overflow-wrap: anywhere;
        }

        .sidebar-toggle {
            border: 1px solid #d5e0ee;
            background: #f6faff;
            color: #1a3556;
            border-radius: 10px;
            min-width: 38px;
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            padding: 0;
        }
        
        .theme-toggle {
            border: 1px solid #d5e0ee;
            background: #f6faff;
            color: #1a3556;
            border-radius: 999px;
            min-height: 38px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            transition: background-color .2s ease, border-color .2s ease, color .2s ease;
        }

        .theme-toggle:hover {
            background: #eaf1fb;
            border-color: #b4c9e4;
        }

        html[data-theme="dark"] body {
            background: #0b1422 !important;
        }

        html[data-theme="dark"] .topbar {
            background: rgba(14, 24, 39, 0.94);
            border-bottom-color: #1f3047;
            color: #e5eefc;
        }

        html[data-theme="dark"] .topbar h5 {
            color: #e7f0ff;
        }

        html[data-theme="dark"] .sidebar-toggle,
        html[data-theme="dark"] .theme-toggle {
            background: #122238;
            border-color: #2a3f5d;
            color: #cce0ff;
        }

        html[data-theme="dark"] .theme-toggle:hover {
            background: #18304f;
            border-color: #3b5780;
        }

        body.sidebar-collapsed .sidebar {
            transform: translateX(-240px);
        }

        body.sidebar-collapsed .topbar,
        body.sidebar-collapsed .content-area {
            margin-left: 0;
        }

        .sidebar-overlay {
            display: none;
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
                height: 100vh;
            }

            .topbar,
            .content-area {
                margin-left: 0 !important;
            }

            .topbar {
                padding: 12px 16px;
                gap: 12px;
                align-items: flex-start !important;
                flex-wrap: wrap;
            }

            .topbar-primary,
            .topbar-actions {
                width: 100%;
            }

            .topbar-actions {
                justify-content: space-between;
                gap: 12px !important;
            }

            .topbar-title {
                font-size: 1rem;
            }

            .content-area {
                padding: 16px;
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            /* Keep the 3-line toggle inside the sidebar area when open */
            body.sidebar-open #sidebarToggle {
                position: fixed;
                top: 12px;
                left: 14px;
                z-index: 1050;
                background: rgba(255, 255, 255, 0.14);
                border-color: rgba(255, 255, 255, 0.32);
                color: #f8fbff;
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                background: rgba(2, 10, 22, 0.45);
                z-index: 1030;
            }

            body.sidebar-open .sidebar-overlay {
                display: block;
            }
        }

        @media (max-width: 575px) {
            .topbar {
                padding: 12px;
            }

            .theme-toggle {
                padding: 0 10px;
            }

            .theme-toggle span {
                display: none;
            }
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
    <h5 class="sidebar-brand text-center">AIML Admin</h5>

    <a href="<?php echo BASE_URL; ?>/admin/main_home.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="<?php echo BASE_URL; ?>/admin/committe/assoc.php"><i class="bi bi-building me-2"></i> Pragya AI</a>
    <a href="<?php echo BASE_URL; ?>/admin/Department/department.php"><i class="bi bi-mortarboard me-2"></i> Department</a>
    <a href="<?php echo BASE_URL; ?>/admin/users/users.php"><i class="bi bi-people me-2"></i> Users</a>
    <a href="<?php echo BASE_URL; ?>/admin/gallery/gallery.php"><i class="bi bi-images me-2"></i> Gallery</a>
    <a href="<?php echo BASE_URL; ?>/admin/settings/otheroperations.php"><i class="bi bi-gear me-2"></i> Core Settings</a>

    <hr class="bg-secondary">

    <a href="<?php echo BASE_URL; ?>/admin/settings/changepassword.php"><i class="bi bi-key me-2"></i> Change Password</a>
    <a href="<?php echo BASE_URL; ?>/admin/logout.php" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
</div>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Topbar -->
<div class="topbar d-flex justify-content-between align-items-center">
    <div class="topbar-primary d-flex align-items-center gap-2">
        <button id="sidebarToggle" type="button" class="sidebar-toggle" aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>
        <h5 class="topbar-title mb-0">Welcome, <?php echo $_SESSION['adminFirstName'] ?? 'Admin'; ?>!</h5>
    </div>

    <div class="topbar-actions d-flex align-items-center gap-3">
        <button id="themeToggle" type="button" class="theme-toggle" aria-label="Switch theme">
            <i id="themeToggleIcon" class="bi bi-moon-stars-fill"></i>
            <span id="themeToggleText">Dark</span>
        </button>
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
<script>
    (function () {
        var body = document.body;
        var btn = document.getElementById('sidebarToggle');
        var themeBtn = document.getElementById('themeToggle');
        var themeIcon = document.getElementById('themeToggleIcon');
        var themeText = document.getElementById('themeToggleText');
        var overlay = document.getElementById('sidebarOverlay');
        var desktop = window.matchMedia('(min-width: 992px)');
        var root = document.documentElement;

        if (!btn) return;

        function updateThemeUI(theme) {
            if (!themeIcon || !themeText) return;
            if (theme === 'dark') {
                themeIcon.className = 'bi bi-sun-fill';
                themeText.textContent = 'Light';
            } else {
                themeIcon.className = 'bi bi-moon-stars-fill';
                themeText.textContent = 'Dark';
            }
        }

        updateThemeUI(root.getAttribute('data-theme') || 'light');

        if (themeBtn) {
            themeBtn.addEventListener('click', function () {
                var current = root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
                var next = current === 'dark' ? 'light' : 'dark';
                root.setAttribute('data-theme', next);
                updateThemeUI(next);
                try {
                    localStorage.setItem('admin-theme', next);
                } catch (e) {}
            });
        }

        btn.addEventListener('click', function () {
            if (desktop.matches) {
                body.classList.toggle('sidebar-collapsed');
            } else {
                body.classList.toggle('sidebar-open');
            }
        });

        if (overlay) {
            overlay.addEventListener('click', function () {
                body.classList.remove('sidebar-open');
            });
        }

        window.addEventListener('resize', function () {
            if (desktop.matches) {
                body.classList.remove('sidebar-open');
            } else {
                body.classList.remove('sidebar-collapsed');
            }
        });
    })();
</script>
