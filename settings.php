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
    <link rel="stylesheet" href="setting.css">
</head>
<body>
    <style>
        body{
	background-color: F1EFEF;
}

.head{
	height: 80px;
	width: 100%;
	background-color: #004225;
	position: absolute;
	top: 0px;
	left: 0px;
}

.asp1{
	letter-spacing: 10px;
	color: white;
	font-family: Bahnschrift SemiBold;
	font-size: 40px;
	position: absolute;
	top: -20px;
	left: 555px;
}

.asp2{
	font-weight: bold;
	font-family: Bahnschrift Light;
	color: #434242;
	font-size: 25px;
	position: absolute;
	top: 80px;
	left: 570px;
}

.asd1{
	background-color: white;
	height: 650px;
	width: 1100px;
	position: absolute;
	top: 160px;
	left: 250px;
	border-radius: 10px;
	box-shadow: box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}

.asp3{
	font-family: Segoe UI Semibold;
	font-size: 20px;
	position: absolute;
	top: -5px;
	left: 30px;
}

.profile{
	position: absolute;
	top: 50px;
	left: 50px;
}

.file-container {
	position: relative;
	top:130px;
	left: 190px;
    width: 120px;
    margin: 10px;
}

.file-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
        }

.custom-button {
    display: inline-block;
    padding: 5px 15px;
    background-color: #004225;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.asp4{
	font-family: Segoe UI Semibold;
	font-size: 20px;
	position: absolute;
	top: 190px;
	left: 30px;
}

.asp5{
	font-family: Segoe UI Variable Display;
	font-size: 17px;
	position: absolute;
	top: 230px;
	left: 60px;
}

.fname{
	position: absolute;
	top: 270px;
	left: 60px;
	width: 450px;
	padding:5px 5px;
    font-size: 15px;
    line-height: 1.5;
    background-color: #f8f9fa;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.asp6{
	font-family: Segoe UI Variable Display;
	font-size: 17px;
	position: absolute;
	top: 230px;
	left: 570px;
}

.uname{
	position: absolute;
	top: 270px;
	left: 570px;
	width: 450px;
	padding:5px 5px;
    font-size: 15px;
    line-height: 1.5;
    background-color: #f8f9fa;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.asp7{
	font-family: Segoe UI Variable Display;
	font-size: 17px;
	position: absolute;
	top: 290px;
	left: 60px;
}

.mali{
	position: absolute;
	top: 330px;
	left: 60px;
	width: 450px;
	padding:5px 5px;
    font-size: 15px;
    line-height: 1.5;
    background-color: #f8f9fa;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.asp8{
	font-family: Segoe UI Variable Display;
	font-size: 17px;
	position: absolute;
	top: 290px;
	left: 570px;
}

.no{
	position: absolute;
	top: 330px;
	left: 570px;
	width: 450px;
	padding:5px 5px;
    font-size: 15px;
    line-height: 1.5;
    background-color: #f8f9fa;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.asp9{
	font-family: Segoe UI Semibold;
	font-size: 20px;
	position: absolute;
	top: 420px;
	left: 30px;
}

.asp10{
	font-family: Segoe UI Variable Display;
	font-size: 17px;
	position: absolute;
	top: 460px;
	left: 60px;
}

.cpass{
	position: absolute;
	top: 500px;
	left: 60px;
	width: 300px;
	padding:5px 5px;
    font-size: 15px;
    line-height: 1.5;
    background-color: #f8f9fa;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.asp11{
	font-family: Segoe UI Variable Display;
	font-size: 17px;
	position: absolute;
	top: 450px;
	left: 390px;
}

.npass{
	position: absolute;
	top: 500px;
	left: 390px;
	width: 300px;
	padding:5px 5px;
    font-size: 15px;
    line-height: 1.5;
    background-color: #f8f9fa;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.asp12{
	font-family: Segoe UI Variable Display;
	font-size: 17px;
	position: absolute;
	top: 450px;
	left: 720px;
}

.ccpass{
	position: absolute;
	top: 500px;
	left: 720px;
	width: 300px;
	padding:5px 5px;
    font-size: 15px;
    line-height: 1.5;
    background-color: #f8f9fa;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.asbut1{
	color: white;
	position: absolute;
	left: 480px;
	top: 350px;
	font-family: Microsoft PhagsPa;
    background-color: #004225;
	font-size: 15px;
    padding: 10px 30px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.asbut2{
	color: white;
	position: absolute;
	left: 50px;
	top: 590px;
	font-family: Microsoft PhagsPa;
    background-color: black;
	font-size: 15px;
    padding: 10px 30px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.asbut3{
	color: white;
	position: absolute;
	left: 480px;
	top: 560px;
	font-family: Microsoft PhagsPa;
    background-color: #004225;
	font-size: 15px;
    padding: 10px 30px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.profile-picture {
    width: 110px;
    height: 110px;
    border-radius: 6px;
    border: 2px solid black;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
	position: absolute;
	top: 60px;
	left: 60px;
}
    </style>
<div class="head">
    <p class="asp1">ACCOUNT SETTING</p>
</div>
<p class="asp2">Change your profile and account settings</p>

<div class="asd1">
    <form method="POST" action="account_settings.php" enctype="multipart/form-data">
        <p class="asp3">Profile Picture</p>
		<?php if (!empty($six1)): ?>
    <img src="<?php echo htmlspecialchars($six1); ?>" alt="Profile Picture" class="profile-picture">
<?php endif; ?>

        <div class="file-container">
            <label for="file" class="custom-button">Choose file</label>
            <input type="file" id="file" class="file-input" name="file">
        </div>
        <p class="asp4">Personal Information</p>
        <p class="asp5">Email</p>
        <input type="text" name="fname" class="fname" value="<?php echo htmlspecialchars($two1); ?>">
        <p class="asp6">Username</p>
        <input type="text" name="uname" class="uname" value="<?php echo htmlspecialchars($first1); ?>">
        <input type="submit" name="submit" value="SAVE" class="asbut1">
        <input type="submit" name="cancel" value="CANCEL" class="asbut2">
    </form>
    <form action="changepass.php" method="POST" enctype="multipart/form-data">
        <p class="asp9">Change Password</p>
        <p class="asp10">Current Password</p>
        <input type="password" name="cpass" class="cpass">
        <p class="asp11">New Password</p>
        <input type="password" name="npass" class="npass" required minlength="6">
        <p class="asp12">Confirm New Password</p>
        <input type="password" name="ccpass" class="ccpass" required minlength="6">
        <input type="submit" name="submit1" value="SAVE" class="asbut3">
    </form>
</div>
</body>
</html>
