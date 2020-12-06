<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<title>Quwius</title>
		<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen">
		<meta charset="utf-8">
	</head>
	<body>
		<nav>
			<a href="/"><img src="images/logo.png" alt="Quwius"></a>
			<ul>
				<li><a href="index.php?Courses">Courses</a></li>
				<li><a href="index.php?Streams">Streams</a></li>
				<li><a href="index.php?AboutUs">About Us</a></li>
				<li><a href='index.php?Login'>Login</a></li>
				<li><a href='index.php?SignUp'>Sign Up</a></li>
				<?php 
				/*$registry = Registry::getInstance();
				$session = $registry->getSession();
				if(!empty($session->receive("Email"))){
					echo "<li><a href='index.php?controller=Logout'>Logout</a></li>";
				}
				else{
					echo "<li><a href='index.php?controller=Login'>Login</a></li>";
					echo "<li><a href='index.php?controller=SignUp'>Sign Up</a></li>";
				}*/
				?>
			</ul>
		</nav>
		<div id="lead-in">
		<h1>Feed Your Curiosity,<br>
				Take Online Courses from UWI</h1>

			<form name="course_search" method="post" action="index.php?controller=">
				<div class="wide-thick-bordered" >
				<input class="c-banner-search-input" type="text" name="formSearch" value="" placeholder="Find the right course for you">
				<button class="c-banner-search-button"></button>
				</div>
			</form>
		</div>
		<header></header>
		<main>
			<h1>Most Popular</h1>

				<?php 
			
				//Iteration variable assigned -1 so when it reached 4 it creates a new line
				//line of images when i % 4 == 0
				$i = -1;

				//Loop through popular array
				foreach($popular as $name => $value):

					$i++;
					if(($i % 4) == 0):
					
				?>

					<div class="centered">

					<?php
					endif;
					?>

					<section>
					<!-- Output the image name $value[4] (Lastt position in array) and 
					tthe tile $value[0] (first position in the array) -->
					<a href="#"><img src="images/<?php echo $value[5] ?>" alt="<?php echo $value[1] ?>" title="<?php echo $value[1] ?>">
					<span class="course-title"><?php echo $value[1] ?></span>
					<span>Course Instructor</span></a>
					</section>

					<?php 
					//If the count is 3 (last iteration before a new row is created) place a div
					if(($i % 4) == 3): 
					?>

					</div>
					<?php 
					endif;
					endforeach;
					?>
				


			
			<h1>Learner Recommended</h1>
			

			<?php 
			
			//Iteration variable assigned -1 so when it reached 4 it creates a new line
			//line of images when i % 4 == 0
			$i = -1;

			//Loop through popular array
			foreach($recommended as $name => $value):

				$i++;
				if(($i % 4) == 0):
				
			?>

				<div class="centered">

				<?php
				endif;
				?>

				<section>
				<!-- Output the image name $value[4] (Lastt position in array) and 
				tthe tile $value[0] (first position in the array) -->
				<a href="#"><img src="images/<?php echo $value[5] ?>" alt="<?php echo $value[1] ?>" title="<?php echo $value[1] ?>">
				<span class="course-title"><?php echo $value[1] ?></span>
				<span>Course Instructor</span></a>
				</section>

				<?php 
				//If the count is 3 (last iteration before a new row is created) place a div
				if(($i % 4) == 3): 
				?>

				</div>
				<?php 
				endif;
				endforeach;
				?>


			<footer>
				<nav>
					<ul>
						<li>&copy;2018 Quwius Inc.</li>
						<li><a href="#">Company</a></li>
						<li><a href="#">Connect</a></li>
						<li><a href="#">Terms &amp; Conditions</a></li>
					</ul>
				</nav>
			</footer>
		</main>
	</body>
</html>