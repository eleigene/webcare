<html>

<head>
	<link rel="stylesheet" href="home.css">
	<link rel="stylesheet" href="loginform1.css">
</head>

<body>
	<div class="dh1">
		<img src="images/mylogo.png" class="ml">
		<h1 class="header"> ELEIbrary </h1>
		<img src="images/hpic1.png" class="logicon">
		<a href="loginform1.php" class="logtext"> Log in/Register </a>
	</div>

	<div class="dh2">
		<a href="index.php" class="home"> Home </a>
		<a href="about.php" class="about"> About </a>
		<a href="shop.php" class="shop"> Shop </a>
	</div>

	<div class="bg1">
	</div>

	<div class="logform">
		<form action="loginform2.php" method="POST">
			<p class="t1"> LOG IN TO YOUR ACCOUNT
			<p>
			<p class="p6"> Username: </p>
			<input type="text" name="username" class="un1">
			<p class="p7"> Password: </p>
			<input type="password" name="password" class="pw1">
			<p class="p8"> Log in as? </p>
			<a href="forgotpass.php" class="p9"> Forgot your password? Click here </a>
			<?php
			if (isset($alert)) {
				foreach ($alert as $alert) {
					echo '<div class="alert">' . $alert . '</div>';
				}
			}
			?>
			<button class="cus1" name="submit1"> LOG IN </button>
		</form>
	</div>

	<img src="images/bg1.jpg" class="bg2">
	<div class="logform2">
		<p class="p10"> WELCOME! </p>
		<p class="p11"> We are happy to have you here. </p>
		<p class="p12"> No Account Yet? </p>
		<p class="p13"> Register and discover a world of words, where every page is an adventure waiting to be explored! </p>
		<button class="but1" onclick="location.href='regform1.php'"> REGISTER </button>
	</div>
</body>

</html>