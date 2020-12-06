<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<title>Login|Quwius</title>
		<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen">
		<meta charset="utf-8">
	</head>
	<body>
		<nav>
			<a href="#"><img src="images/logo.png" alt="UWI online"></a>
			<ul>
				<li><a href="index.php?controller=Courses">Courses</a></li>
				<li><a href="index.php?controller=Streams">Streams</a></li>
				<li><a href="index.php?controller=AboutUs">About Us</a></li>
				<li><a href="index.php?controller=SignUp">Sign Up</a></li>
			</ul>
		</nav>
		<main>
		   <div class="login-box">
			<div class="login-box-body">
			<p class="login-box-msg">Be Curious - Sign In</p>
			<p class="login-box-msg " style="color:#000000">
			<?php 
			if(isset($_GET["successfulSignUp"])){
				echo $_GET["successfulSignUp"];
			}
			//if(isset($_POST['SignUpSuccess'])){
			//	echo "Sign Up Successful, Please login below";
			//}
			?>
			</p>
			
			<form action="" method="post">
			  <div class="form-group has-feedback">
				<input type="text" name="email" class="form-control" placeholder="Email" required/>
			  </div>
			  <div class="form-group has-feedback">
				<input type="password" name="password" class="form-control" placeholder="Password" required/>
			  </div>
			  <div class="row">
				<div class="col-xs-8">    
				  <div class="checkbox icheck">
					<label>
					  <input type="checkbox"> Remember Me
					</label>
				  </div>                        
				</div><!-- /.col -->
				<div class="col-xs-4">
				  <button type="submit" name="login" value="Profile" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div><!-- /.col -->
			  </div>
			</form>
			<br>
			<a href="register.html" class="text-center">Sign Up</a>

			<!--Output Error message for invalid login credentials-->
			<div style="color: #FF0000">
			<?php 
				if(isset($Errors)){
				echo $Errors['Errors'];
				} 
			?>
			</div>

       </div><!-- /.login-box-body -->
	  </div>
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