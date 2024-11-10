<?php
include("connection.php");
session_start();
if (!isset($_SESSION['auth_user'])) {
	exit(); // Ensure that the rest of the page does not load
}
$userID = $_SESSION['auth_user']['UserName'];
$userid = $_SESSION['auth_user']['ID']; // Fixed typo

// Set default values for the user details
$first1 = "Unknown User"; // Default value if no result is found
$two1 = "No email found"; // Default value if no result is found

// Fetch the logged-in user's data
$sql1 = "SELECT * FROM user WHERE userid ='$userid'";
$result1 = mysqli_query($con, $sql1);

if ($result1 && mysqli_num_rows($result1) > 0) {
	// Fetch the data if available
	while ($rows = mysqli_fetch_assoc($result1)) {
		$first1 = $rows['username'];
		$two1 = $rows['email'];
		$six1 = $rows['profile'];
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<!-- Bootstrap 5.3 CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
	<style>
		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}

		#contentSection {
			box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
		}

		.file-input {
			display: none;
		}
	</style>

	<div class="container-fluid mb-4 p-0">

		<!-- HEADER -->
		<div class="container-fluid d-flex flex-column text-center bg-success shadow-sm">
			<div class="container pb-2">
				<p class="pt-4 fs-1 fw-bolder text-white m-0">ACCOUNT SETTING</p>
				<p class="fs-5 text-white fst-italic m-0">Change your profile and account settings</p>
			</div>
		</div>

		<!-- FORMS -->
		<div class="container mt-4 rounded-3 p-0 overflow-hidden" id="contentSection">

			<!-- ROW 1 -->
			<form class="m-0 p-0" method="POST" action="account_settings.php" enctype="multipart/form-data">
				<div class="bg-success-subtle p-2 m-0 text-success fw-semibold">
					Profile Picture
				</div>
				<div class="d-flex flex-column p-2">
					<?php if (!empty($six1)): ?>
						<img src="<?php echo htmlspecialchars($six1); ?>" alt="Profile Picture" width="150" height="100" class="rounded mx-auto d-block border shadow-sm object-fit-cover">
						<!-- <img src="https://images.ctfassets.net/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/24e953b920a9cd0ff2e1d587742a2472/1-intro-photo-final.jpg?w=1200&h=992&fl=progressive&q=70&fm=jpg" alt="Profile Picture" width="150" height="100" class="rounded mx-auto border d-block shadow-sm object-fit-cover"> -->
					<?php endif; ?>
					<div class="text-center mt-2 p-2">
						<label for="file" class="btn btn-sm btn-outline-success">Choose profile picture</label>
						<input type="file" id="file" class="file-input" name="file">
					</div>
				</div>

				<!-- ROW 2 -->
				<div class="bg-success-subtle p-2 m-0 text-success fw-semibold">
					Personal Information
				</div>

				<div class="d-flex flex-column flex-md-row gap-2 p-2">

					<div class="mb-3 w-100">
						<label for="email" class="form-label">Email</label>
						<input type="text" name="fname" class="form-control" id="email" value="<?php echo htmlspecialchars($two1); ?>">
					</div>

					<div class="mb-3 w-100">
						<label for="userName" class="form-label">Username</label>
						<input type="text" name="uname" class="form-control" id="userName" value="<?php echo htmlspecialchars($first1); ?>">
					</div>
					<!-- <input type="submit" name="cancel" value="CANCEL" class="asbut2"> -->
				</div>
				<div class="mx-auto d-flex justify-content-center mb-3">
					<input type="submit" name="submit" value="Save" class="btn btn-sm btn-outline-success px-4">
				</div>
			</form>


			<!-- ROW 3 -->
			<form class="m-0 p-0" action="changepass.php" method="POST" enctype="multipart/form-data">
				<div class="bg-success-subtle p-2 m-0 text-success fw-semibold">
					Change Password
				</div>

				<!-- ROW 4 -->
				<div class="d-flex flex-column flex-md-row gap-2 p-2">
					<div class="mb-3 w-100">
						<label for="cpass" class="form-label">Current Password</label>
						<input type="password" name="cpass" class="form-control" id="cpass">
					</div>

					<div class="mb-3 w-100">
						<label for="npass" class="form-label">New Password</label>
						<input type="password" name="npass" class="form-control" id="npass" required minlength="6">
					</div>

					<div class="mb-3 w-100">
						<label for="ccpass" class="form-label">Confirm New Password</label>
						<input type="password" name="ccpass" class="form-control" id="ccpass" required minlength="6">
					</div>
				</div>

				<div class="mx-auto d-flex justify-content-center gap-2 mb-3">
					<!-- Redirect to home page of user -->
					<a href="userhome.php" class="btn btn-sm btn-success px-4">Cancel</a>
					<input type="submit" name="submit1" value="Save" class="btn btn-sm btn-outline-success px-4">
				</div>
			</form>
		</div>
	</div>

	<!-- Bootstrap 5.3 CDN -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>