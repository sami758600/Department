<?php
     if( session_id() == '' ){
	 	session_start();
	 
	 }
	 
	 if( !isset( $_SESSION['adminId'] ) ){
	 	
		header('Location: index.php');
		return false;
	 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="shortcut icon" href="../images/wise_fav.ico"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>MBA Department</title>
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="../styles/style.css" />

		<script type="text/javascript" src="../js/jquery.min.js"></script>

		<!-- pretty photo -->
		<link rel="stylesheet" href="../styles/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="../js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>


		<script type="text/javascript">
			$(document).ready(function() {
				
				$("area[rel^='image']").prettyPhoto();
				
					$(".gallery:first a[rel^='image']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:5000, autoplay_slideshow: true});
					$(".gallery:gt(0) a[rel^='image']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:5000, autoplay_slideshow: true});

				
			});
		</script>


	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<h1><a href="index.php"><img src="../images/wise.png" alt="WISE" title="WISE"  /></a></h1>
				</div>
				<!--
				<div id="search">
					<form action="search.php" method="post">
						<div>
							<input class="form-text" name="search" size="32" maxlength="64" /><input class="form-submit" type="submit" value="Search" />
						</div>
					</form>
				</div>
				-->
				<div id="menu">
					<ul>
						<li class="first current_page_item"><a href="main_home.php">Home</a></li>
						<li><a href="assoc.php">Assoc Name</a></li>
						<li><a href="department.php">MBA Department</a></li>
						<li><a href="users.php">Users</a></li>
						<li><a href="gallery.php">Gallery</a></li>								
						<li><a href="sliderimages.php">Slide Images</a></li>
						<li class="last"><a href="otheroperations.php">Core</a></li>
					</ul>
					<ul id="logDetails">
						<?php if(!isset($_SESSION['adminId'])){ ?>
									<li>	<a href="index.php">Login</a>
							<?php }else{ ?> 
									<li style="padding:0">	
										<div class="userImage">
											<img src="../images/admin/<?php echo $_SESSION['adminImage']?>" width="45px" height="45px" />
										</div>
										<div class="userName">
											<span class="sessionName">
												<?php echo $_SESSION['adminFirstName']?>
											</span>
											<span class="changePass">
												<a href="changepassword.php">Change Password </a>
											</span>
										</div>
							<?php } ?> 									
						</li>
						<li class="last"><?php if(!isset($_SESSION['adminId'])){ ?>
										
							<?php } else{ ?> 
										<a href="logout.php">Logout</a>
							<?php } ?>  	
						</li>
					</ul>
					<br class="clearfix" />
				</div>
			</div>
	<!--	<div id="splash">
				<div id='coin-slider'>
					
					<img src='../images/sliderimages/image_1.png' >
					<span>
						Women Innovative Software Engineers
					</span>
					<img src='../images/sliderimages/image_2.png' >
					<span>
						
					</span>
					<img src='../images/sliderimages/image_3.png' >
					<span>
						
					</span>
					<img src='../images/sliderimages/image_4.png' >
					<span>
						
					</span>
					<img src='../images/sliderimages/image_5.png' >
					<span>
						
					</span>
					<img src='../images/sliderimages/image_6.png' >
					<span>
						
					</span>
					<!--
					<a href="sliderimages/image_3.png" target="_blank">
						<img src='sliderimages/image_3.png' >
						<span>
							
						</span>
					</a>
					<a href="sliderimages/image_4.png" target="_blank">
						<img src='sliderimages/image_4.png' >
						<span>
							
						</span>
					</a>
					<a href="sliderimages/image_5.png" target="_blank">
						<img src='sliderimages/image_5.png' >
						<span>
							
						</span>
					</a>
					<!--
		 		</div>
			</div>
		-->