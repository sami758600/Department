<?php
if (!isset($userActivePage) || !is_string($userActivePage)) {
    $userActivePage = 'dashboard';
}

function userNavActive($key, $active)
{
    return $key === $active ? ' active' : '';
}

$welcomeName = trim((string)($_SESSION['firstName'] ?? $_SESSION['userName'] ?? 'Student'));
if ($welcomeName === '') {
    $welcomeName = 'Student';
}

$userImageFile = trim((string)($_SESSION['image'] ?? ''));
$userImageUrl = '';
if ($userImageFile !== '') {
    $userImageUrl = BASE_URL . '/public/assets/images/users/' . rawurlencode($userImageFile);
}

$userInitial = strtoupper(substr($welcomeName, 0, 1));
if ($userInitial === '') {
    $userInitial = 'S';
}
?>

<div class="container user-profile-wrap user-layout-wrap">
    <div class="user-dashboard-shell row g-4">
        <div class="col-lg-3">
            <aside class="user-side-panel" id="user-sidebar">
                <h5 class="user-sidebar-brand text-center">AIML User</h5>

                <nav class="user-side-nav user-side-nav-main">
                    <a class="user-side-link<?php echo userNavActive('dashboard', $userActivePage); ?>" href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php"><i class="bi bi-speedometer2 user-side-link-icon"></i><span>Dashboard</span></a>
                    <a class="user-side-link<?php echo userNavActive('academics', $userActivePage); ?>" href="<?php echo BASE_URL; ?>/public/pages/user/academics.php"><i class="bi bi-mortarboard user-side-link-icon"></i><span>Academics</span></a>
                    <a class="user-side-link" href="https://erp.nrcmec.org/"><i class="bi bi-journal-check user-side-link-icon"></i><span>Exam Cell</span></a>
                    <a class="user-side-link<?php echo userNavActive('achievements', $userActivePage); ?>" href="<?php echo BASE_URL; ?>/public/pages/user/achievements.php"><i class="bi bi-trophy user-side-link-icon"></i><span>Upload Achievement</span></a>
                    <a class="user-side-link<?php echo userNavActive('profile', $userActivePage); ?>" href="<?php echo BASE_URL; ?>/public/pages/user/profile.php"><i class="bi bi-person-gear user-side-link-icon"></i><span>Account Settings</span></a>
                    <a class="user-side-link<?php echo userNavActive('downloads', $userActivePage); ?>" href="<?php echo BASE_URL; ?>/public/pages/user/downloads.php"><i class="bi bi-download user-side-link-icon"></i><span>Downloads</span></a>
                    <a class="user-side-link<?php echo userNavActive('studentsupport', $userActivePage); ?>" href="<?php echo BASE_URL; ?>/public/pages/user/studentsupport.php"><i class="bi bi-headset user-side-link-icon"></i><span>Student Support</span></a>

                </nav>

                <nav class="user-side-nav user-side-nav-utility">
                    <a class="user-side-link user-side-link-logout" href="<?php echo BASE_URL; ?>/public/pages/Authentication/logout.php"><i class="bi bi-box-arrow-right user-side-link-icon"></i><span>Logout</span></a>
                </nav>
            </aside>
        </div>

        <div class="col-lg-9">
            <div class="user-page-topbar">
                <div class="user-page-topbar-left">
                    <button type="button" class="user-sidebar-toggle" id="userSidebarToggle" aria-controls="user-sidebar" aria-expanded="true" aria-label="Toggle user menu">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="user-page-greet">Welcome, <?php echo htmlspecialchars($welcomeName); ?>!</div>
                </div>

                <div class="user-page-topbar-right">
                    <?php if ($userImageUrl !== '') { ?>
                        <img src="<?php echo htmlspecialchars($userImageUrl); ?>" alt="User" class="user-topbar-avatar" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';">
                        <span class="user-topbar-avatar-fallback" style="display:none;"><?php echo htmlspecialchars($userInitial); ?></span>
                    <?php } else { ?>
                        <span class="user-topbar-avatar-fallback"><?php echo htmlspecialchars($userInitial); ?></span>
                    <?php } ?>
                </div>
            </div>

