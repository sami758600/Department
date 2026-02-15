<?php
     if( session_id() == '' ){
	 	session_start();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="shortcut icon" href="images/wise_fav.ico"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>MBA Department</title>
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="styles/reset.css" type="text/css" media="all">
		<link rel="stylesheet" href="styles/layout.css" type="text/css" media="all">
		<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Google Font (optional but recommended) -->
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
		<style>
		body {
			font-family: 'Poppins', sans-serif;
		}
		</style>
		<script type="text/javascript" src="js/jquery.min.js"></script>

		<!-- image slide show -->
		<script type="text/javascript" src="js/coin-slider.min.js"></script>
		<link rel="stylesheet" href="styles/coin-slider-styles.css" type="text/css" />

		<!-- pretty photo -->
		<link rel="stylesheet" href="styles/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>


		<script type="text/javascript">
			$(document).ready(function() {
				
				$("area[rel^='image']").prettyPhoto();
				
					$(".gallery:first a[rel^='image']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:5000, autoplay_slideshow: true});
					$(".gallery:gt(0) a[rel^='image']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:5000, autoplay_slideshow: true});

				
			});
		</script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#coin-slider').coinslider({ height: 180, opacity: 0.7 ,effect: 'straight'});
			});
		</script>

	</head>

<body id="page1">
<div class="body1">
  <div class="main">
    <!-- header -->
    <header>
      <div class="wrapper">
        <nav>
          <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="assoc.php">Assoc Name</a></li>
            <li><a href="department.php">MBA Department</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="paper.php">Press News </a></li>
			<li><a href="aboutit.php">About IT</a></li>
			<li ><a href="contactus.php">Contact Us</a></li>
			<?php if(!isset($_SESSION['userId'])){ ?>
									<li>	<a href="login.php">Login</a>
							<?php }else{ ?> 
									<li style="padding:0">	
										<div class="userImage">
											<img src="images/users/<?php echo $_SESSION['image']?>" width="45px" height="45px" />
										</div>
										<div class="userName">
											<span class="sessionName">
												<?php echo $_SESSION['firstName']?>
											</span>
											<span class="changePass">
												<a href="changepassword.php">Change Profile </a>
											</span>
										</div>
							<?php } ?> 									
						</li>
						<li class="end"><?php if(!isset($_SESSION['userId'])){ ?>
										<a href="register.php">Register</a>
							<?php } else{ ?> 
										<a href="logout.php">Logout</a>
							<?php } ?>  	
						</li>
			            

          </ul>
        </nav>
		<?php if(!isset($_SESSION['userId'])){ ?>
        <ul id="icon">
          <li><a href="#"><img src="images/icon1.jpg" alt=""></a></li>
          <li><a href="#"><img src="images/icon2.jpg" alt=""></a></li>
          <li><a href="#"><img src="images/icon3.jpg" alt=""></a></li>
        </ul>
		<?php }else{ ?> 
		<?php } ?> 
      </div>
      <div class="wrapper">
        <h1><a href="index.php" id="logo">Learn Center</a></h1>
      </div>
      <div id="slogan"> We Will Open The World<span>of knowledge for you!</span> </div>
      <ul class="banners">
        <li><a href="#"><img src="images/banner1.jpg" alt=""></a></li>
        <li><a href="#"><img src="images/banner2.jpg" alt=""></a></li>
        <li><a href="#"><img src="images/banner3.jpg" alt=""></a></li>
      </ul>
    </header>
    <!-- / header -->
  </div>
</div>

<div class="body2">
  <div class="main">
    <!-- content -->
    <section id="content">
			<div class="wrapper">
				<div class="pad1 pad_top1">
				  <article class="cols marg_right1">
					<figure><a href="#"><img src="images/page1_img1.jpg" alt=""></a></figure>
					<span class="font1">Our Mission Statement</span> </article>
				  <article class="cols marg_right1">
					<figure><a href="#"><img src="images/page1_img2.jpg" alt=""></a></figure>
					<span class="font1">Performance Report</span> </article>
				  <article class="cols">
					<figure><a href="#"><img src="images/page1_img3.jpg" alt=""></a></figure>
					<span class="font1">Prospective Parents</span> </article>
				</div>
			  </div>
				

