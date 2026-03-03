<?php
if (session_id() == '') {
    session_start();
}

$requestPath = strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$basePath = strtolower(rtrim(BASE_URL, '/'));
$relativePath = $requestPath;

if ($basePath !== '' && strpos($requestPath, $basePath) === 0) {
    $relativePath = substr($requestPath, strlen($basePath));
    if ($relativePath === '') {
        $relativePath = '/';
    }
}

if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
    $allowedUserPaths = array(
        '/public/pages/user/dashboard.php',
        '/public/pages/user/academics.php',
        '/public/pages/user/profile.php',
        '/public/pages/user/achievements.php',
        '/public/pages/user/downloads.php',
        '/public/pages/authentication/logout.php'
    );

    if (!in_array($relativePath, $allowedUserPaths, true)) {
        header('Location: ' . BASE_URL . '/public/pages/user/dashboard.php');
        exit;
    }
}

$currentPage = basename($_SERVER['PHP_SELF']);
$isUserArea = isset($_SESSION['role']) && $_SESSION['role'] === 'user';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIML Department</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/newstyle.css">


</head>

<body class="<?php echo $isUserArea ? 'user-role' : ''; ?>">

<!-- ================= NAVBAR ================= -->
<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3"> -->
<!-- <nav class="navbar navbar-expand-lg navbar-dark custom-navbar"> -->
    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark shadow-sm custom-navbar">


    <div class="container">
        <a class="navbar-brand fw-bold" href="<?php echo $isUserArea ? (BASE_URL . '/public/pages/user/dashboard.php') : (BASE_URL . '/'); ?>">
            <?php echo $isUserArea ? 'Department Portal' : 'Department of AIML'; ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-center">

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') { ?>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"  href="<?php echo BASE_URL; ?>/public/pages/department/department.php">Departments</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/public/pages/Events/events.php">Events</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/public/pages/gallery.php">Gallery</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/public/pages/placements.php">Placements</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/public/pages/aboutit.php">About Us</a>
                    </li>

                <?php if (!isset($_SESSION['userId'])) { ?>
                    <li class="nav-item ms-3">
                        <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/login.php" class="btn btn-warning btn-sm">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/register.php" class="btn btn-outline-light btn-sm">Register</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item ms-3">
                        <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/logout.php" class="btn btn-warning btn-sm">Logout</a>
                    </li>
                <?php } ?>
                <?php } ?>

            </ul>
        </div>
    </div>
</nav>

<?php if ($isUserArea) { ?>
<div id="userMobileBar" class="user-mobile-bar">
    <button type="button" id="userMobileMenuBtn" class="user-mobile-menu-btn" aria-label="Toggle navigation">
        <i class="bi bi-list"></i>
    </button>
    <span class="user-mobile-title">Department Portal</span>
</div>
<div id="userNavBackdrop" class="user-nav-backdrop" aria-hidden="true"></div>
<?php } ?>


<!-- ================= HERO (ONLY INDEX PAGE) ================= -->
<?php if ($currentPage == "index.php") { ?>
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="display-4 fw-bold text-white">
                Code. Learn. Evolve.
            </h1>
            <p class="lead text-light mt-3">
                Transforming ideas into AI-driven solutions.
            </p>

            <div class="mt-4">
                <a href="<?php echo BASE_URL; ?>/public/pages/department/department.php" class="btn btn-warning me-3">
                    Explore Department
                </a>
                <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/register.php" class="btn btn-outline-light">
                    Admissions 2026
                </a>
            </div>
        </div>
    </div>
</section>
<?php } ?>





<!-- <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">

  <div class="carousel-inner">

    <?php for($i=1; $i<=6; $i++){ ?>
        <div class="carousel-item <?php if($i==1) echo 'active'; ?>">
            <img src="images/sliderimages/image_<?php echo $i; ?>.png" 
                 class="d-block w-100"
                 style="height:400px; object-fit:cover;">
        </div>
    <?php } ?>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
  </button>

</div> -->



<script>
(function () {
    function setUserNavbarHeight() {
        if (!document.body.classList.contains('user-role')) {
            return;
        }
        var mobileBar = document.getElementById('userMobileBar');
        var isMobile = window.matchMedia('(max-width: 991px)').matches;
        var offset = (mobileBar && isMobile) ? mobileBar.offsetHeight : 0;
        document.body.style.setProperty('--user-navbar-height', offset + 'px');
    }

    function setupUserMobileNav() {
        if (!document.body.classList.contains('user-role')) {
            return;
        }

        var menuBtn = document.getElementById('userMobileMenuBtn');
        var backdrop = document.getElementById('userNavBackdrop');
        if (!menuBtn || !backdrop) {
            return;
        }

        function closeNav() {
            document.body.classList.remove('user-nav-open');
        }

        menuBtn.addEventListener('click', function () {
            document.body.classList.toggle('user-nav-open');
        });

        backdrop.addEventListener('click', closeNav);

        document.addEventListener('click', function (event) {
            if (!document.body.classList.contains('user-nav-open')) {
                return;
            }
            var sidebar = document.querySelector('.user-dashboard-shell > .col-lg-3');
            if (!sidebar) {
                return;
            }
            if (sidebar.contains(event.target) || menuBtn.contains(event.target)) {
                return;
            }
            closeNav();
        });

        var sidebarLinks = document.querySelectorAll('.user-dashboard-shell > .col-lg-3 .user-side-link');
        for (var i = 0; i < sidebarLinks.length; i++) {
            sidebarLinks[i].addEventListener('click', function () {
                if (window.matchMedia('(max-width: 991px)').matches) {
                    closeNav();
                }
            });
        }

        window.addEventListener('resize', function () {
            if (!window.matchMedia('(max-width: 991px)').matches) {
                closeNav();
            }
        });
    }

    window.addEventListener('load', setUserNavbarHeight);
    window.addEventListener('resize', setUserNavbarHeight);
    setUserNavbarHeight();
    setupUserMobileNav();
})();
</script>

<section class="page-content <?php echo $isUserArea ? 'user-page-content' : 'py-5'; ?>">
