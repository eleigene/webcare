<html>
<head>
	<link rel="stylesheet" href="home.css">
	<link rel="stylesheet" href="regform1.css">
</head>
<body>
	<div class="dh1">
		<img src="images/mylogo.png" class="ml">
		<h1 class="header"> ELEIbrary </h1>
		<img src="images/hpic1.png" class="logicon">
		<a href="loginform1.php" class="logtext"> Log in/Register </a>
		</div>

		<div class="dh2">
			<a href="home.php" class="home"> Home </a>
			<a href="about.php" class="about"> About </a>
			<a href="shop.php" class="shop"> Shop </a>
		</div>
			
		<div class="bg1">
		</div>
		
		<div class="regform">
		<form method="POST">
		<p class="e1"> CREATE AN ACCOUNT </p>
        <div class="field">
		<input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="field">
        <input type="text" name="email" placeholder="Email Address" required>
</div>
<div class="field">
        <input type="password" name="password" placeholder="Password" required>
</div>
<div class="field">
        <input type="password" name="cpassword" placeholder="Confirm password" required>
</div>
		<?php
			if(isset($alert)){
				foreach ($alert as $alert) {
					echo '<div class="alert">'.$alert.'</div>';
				}
			}
		?>
        <div class="field btn">
        <div class="btn-layer"></div>
		<button type="submit" name="submit" class="cus2" formaction="email.php">  REGISTER </button>
        </div>
        <div class="login-link">
                                Already have an account? <a href="" id="openLoginFromSignup">Login now</a>
                            </div>
		</form>
		</div>
		
		<img src="images/bg1.jpg" class="bg2">
		<div class="regform2">
		<p class="e3"> REGISTER </p>
		<p class="e4"> to use all features of the website. </p>
		<p class="e5"> ELEIbrary is much better when you have an account. </p>
		<p class="e6"> Get yourself one! </p>
		<p class="e7"> Already have an existing account? </p>
		<button class="but2" onclick="location.href='loginform1.php'">  LOG IN </button>
		</div>
</body>
</html>