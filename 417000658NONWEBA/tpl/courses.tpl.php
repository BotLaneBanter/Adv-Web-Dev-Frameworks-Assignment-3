<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<title>Quwius</title>
		<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen">
		<meta charset="utf-8">
	</head>
	<body>
		<nav>
			<a href="#"><img src="images/logo.png" alt="UWI online"></a>
			<ul>
				<li><a href="courses.php?controller=Streams">Streams</a></li>
				<li><a href="courses.php?controller=AboutUs">About Us</a></li>
				<?php 
				if(isset($_SESSION)){
					echo "<li><a href='courses.php?controller=Profile'>Profile</a></li>";
					echo "<li><a href='courses.php?controller=Logout'>Logout</a></li>";
				}
				else{
					echo "<li><a href='courses.php?controller=Login'>Login</a></li>";
					echo "<li><a href=\"courses.php?controller=SignUp\">Sign Up</a></li>";
				}
				?>
				
			</ul>
		</nav>
		<main>
		<h1>Courses</h1>
		<ul class="course-list">
			
			<!--Output For User Courses-->
			<?php 
			
			 foreach($courses as $key => $value):
			?>
			<li><div>
				<a href="#"><img src="images/<?php echo $value[1] ?>" alt="<?php echo $value[0] ?>"></a>
				</div>
				<div>
				<a href="#"><span class="faculty-department"><?php echo $value[2] ?></span>	
					<span class="course-title"><?php echo $value[0] ?></span>
					<span class="instructor"><?php echo $value[3] ?></span></a>
				</div>
				<div>
					<p>Get Curious.</p>
					<a href="#" class="startnow-button startnow-btn">Start Now!</a>
				</div>
			</li>
			<?php 
			   endforeach; 
			?>
			<!--End Of Output For User Courses-->
			
		</ul>
			<footer>
				<nav>
					<ul>
						<li>&copy;2015 Quwius Inc.</li>
						<li><a href="#">Company</a></li>
						<li><a href="#">Connect</a></li>
						<li><a href="#">Terms &amp; Conditions</a></li>
					</ul>
				</nav>
			</footer>
		</main>
	</body>
</html>