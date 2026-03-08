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
        '/public/pages/user/studentsupport.php',
        '/public/pages/authentication/logout.php'
    );

    if (!in_array($relativePath, $allowedUserPaths, true)) {
        header('Location: ' . BASE_URL . '/public/pages/user/dashboard.php');
        exit;
    }
}

$currentPage = basename($_SERVER['PHP_SELF']);
$isUserArea = isset($_SESSION['role']) && $_SESSION['role'] === 'user';
$currentPath = strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$isHomePage = $currentPage === 'index.php';
$isDepartmentsPage = strpos($currentPath, '/public/pages/department/') !== false;
$isEventsPage = strpos($currentPath, '/public/pages/events/') !== false;
$isGalleryPage = strpos($currentPath, '/public/pages/gallery.php') !== false;
$isPlacementsPage = strpos($currentPath, '/public/pages/placements.php') !== false;
$isAboutPage = strpos($currentPath, '/public/pages/aboutit.php') !== false;

$bodyClasses = array();
if ($isUserArea) {
    $bodyClasses[] = 'user-role';
}
if ($isHomePage) {
    $bodyClasses[] = 'home-page';
}

$heroRobotWebPath = BASE_URL . '/public/assets/images/hero-robot.png';
$heroRobotFsPath = ROOT_PATH . '/public/assets/images/hero-robot.png';
$hasHeroRobotImage = $isHomePage && is_file($heroRobotFsPath);
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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/site-refresh.css">
    <?php if ($isHomePage) { ?>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <?php } ?>


</head>

<body class="<?php echo implode(' ', $bodyClasses); ?>">

<!-- ================= NAVBAR ================= -->
<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3"> -->
<!-- <nav class="navbar navbar-expand-lg navbar-dark custom-navbar"> -->
    <?php if (!$isUserArea) { ?>
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
                        <a class="nav-link <?php echo $isHomePage ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $isDepartmentsPage ? 'active' : ''; ?>"  href="<?php echo BASE_URL; ?>/public/pages/department/department.php">Departments</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $isEventsPage ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/public/pages/Events/events.php">Events</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $isGalleryPage ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/public/pages/gallery.php">Gallery</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $isPlacementsPage ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/public/pages/placements.php">Placements</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $isAboutPage ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>/public/pages/aboutit.php">About Us</a>
                    </li>

                <?php if (!isset($_SESSION['userId'])) { ?>
                    <li class="nav-item ms-3">
                        <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/login.php" class="btn btn-warning btn-sm nav-login-btn">Login</a>
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
<?php } ?>


<!-- ================= HERO (ONLY INDEX PAGE) ================= -->
<?php if ($isHomePage) { ?>
<section class="hero-section">
    <div class="hero-glow"></div>
    <div class="container hero-layout">
        <div class="hero-panel" data-aos="fade-up">
            <span class="hero-badge">Admissions Open 2026</span>
            <h1 class="hero-title">
                Code. Learn. <span class="typing">Evolve.</span>
            </h1>
            <p class="hero-subtitle">
                Transforming ideas into AI-driven solutions through research, hands-on labs, and industry-ready learning paths.
            </p>

            <div class="hero-actions">
                <a href="<?php echo BASE_URL; ?>/public/pages/department/department.php" class="btn cta-btn">
                    Explore Department
                </a>
                <a href="<?php echo BASE_URL; ?>/public/pages/Authentication/register.php" class="btn btn-outline-light">
                    Admissions 2026
                </a>
            </div>

            <div class="hero-stats" data-aos="fade-up" data-aos-delay="140">
                <div class="hero-stat">
                    <strong>1200+</strong>
                    <span>Students</span>
                </div>
                <div class="hero-stat">
                    <strong>25+</strong>
                    <span>Research Labs</span>
                </div>
                <div class="hero-stat">
                    <strong>40+</strong>
                    <span>2025 Placements</span>
                </div>
            </div>
        </div>

        <div class="hero-visual-wrap" data-aos="fade-left" data-aos-delay="180">
            <div class="hero-visual<?php echo $hasHeroRobotImage ? ' has-hero-image' : ''; ?>">
                <div class="hero-orb hero-orb-1"></div>
                <div class="hero-orb hero-orb-2"></div>
                <div class="hero-orb hero-orb-3"></div>
                <?php if ($hasHeroRobotImage) { ?>
                <img
                    src="<?php echo $heroRobotWebPath; ?>"
                    alt="AI Robot"
                    class="hero-robot-image"
                    loading="eager"
                >
                <?php } else { ?>
                <div class="ai-core">
                    <i class="bi bi-cpu-fill" aria-hidden="true"></i>
                    <span>AI Brain</span>
                </div>
                <?php } ?>
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



<?php if ($isHomePage) { ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
(function () {
    if (window.AOS) {
        window.AOS.init({
            duration: 700,
            once: true,
            offset: 40
        });
    }

    var words = ["Evolve.", "Innovate.", "Build AI.", "Lead the Future."];
    var index = 0;
    var letter = 0;
    var isDeleting = false;
    var typingElement = document.querySelector(".typing");

    if (!typingElement) {
        return;
    }

    function typeWord() {
        var currentWord = words[index];

        if (isDeleting) {
            typingElement.textContent = currentWord.substring(0, letter--);
        } else {
            typingElement.textContent = currentWord.substring(0, letter++);
        }

        if (!isDeleting && letter === currentWord.length + 1) {
            isDeleting = true;
            setTimeout(typeWord, 1200);
            return;
        }

        if (isDeleting && letter === 0) {
            isDeleting = false;
            index = (index + 1) % words.length;
        }

        setTimeout(typeWord, isDeleting ? 60 : 120);
    }

    typeWord();
})();
</script>
<?php } ?>

<script>
(function () {
    function setUserNavbarHeight() {
        if (!document.body.classList.contains('user-role')) {
            return;
        }
        var nav = document.getElementById('mainNavbar');
        if (!nav) {
            return;
        }
        document.body.style.setProperty('--user-navbar-height', nav.offsetHeight + 'px');
    }

    window.addEventListener('load', setUserNavbarHeight);
    window.addEventListener('resize', setUserNavbarHeight);
    setUserNavbarHeight();
})();
</script>

<section class="page-content <?php echo $isUserArea ? 'user-page-content' : 'py-5'; ?>">


