<?php
if (session_id() == '') {
    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AIML Department</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="public/assets/css/newstyle.css">
</head>

<body>

<!-- ================= NAVBAR ================= -->
<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3"> -->
<!-- <nav class="navbar navbar-expand-lg navbar-dark custom-navbar"> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-sm">


    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            Department of AIML
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="public/pages/department/department.php">Departments</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="public/pages/events.php">Events</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="public/pages/gallery.php">Gallery</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="public/pages/placements.php">Placements</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="public/pages/aboutit.php">About Us</a>
                </li>

                <?php if (!isset($_SESSION['userId'])) { ?>
                    <li class="nav-item ms-3">
                        <a href="public/pages/Authentication/login.php" class="btn btn-warning btn-sm">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="public/pages/register.php" class="btn btn-outline-light btn-sm">Register</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item ms-3">
                        <a href="public/pages/Authentication/logout.php" class="btn btn-warning btn-sm">Logout</a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</nav>


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
                <a href="public/pages/department/department.php" class="btn btn-warning me-3">
                    Explore Department
                </a>
                <a href="public/pages/register.php" class="btn btn-outline-light">
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



<section class="page-content py-5">
