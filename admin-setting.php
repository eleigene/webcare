<?php
include("connection.php");
session_start();
// Fetch admin username
$sql = "SELECT username FROM admin WHERE adminid = 0"; // Assuming adminid = 0 is the admin
$result = mysqli_query($con, $sql);

$admin_username = '';

if ($result->num_rows > 0) {
    // Fetch the username
    $row = $result->fetch_assoc();
    $admin_username = $row['username'];
} else {
    echo "No admin found";
}

$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Setting</title>
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

.cancel{
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
 <form method="POST" action="change.php" enctype="multipart/form-data">
    <input type="hidden" name="adminid" value="0"> <!-- Hidden admin ID -->
    <p class="asp4">Personal Information</p>
    <p class="asp5">Email</p>
    <input type="text" name="fname" class="fname" value="<?php echo htmlspecialchars($admin_username); ?>">
    <input type="submit" name="submit" value="SAVE" class="asbut1">
    <a href="dashboard.php" class="cancel">Cancel</a>
</form>
    <form action="admin-changeu.php" method="POST" enctype="multipart/form-data">
        <p class="asp9">Change Password</p>
        <p class="asp10">Current Password</p>
        <input type="password" name="cpass" class="cpass" required minlength="6">
        <p class="asp11">New Password</p>
        <input type="password" name="npass" class="npass" required minlength="6">
        <p class="asp12">Confirm New Password</p>
        <input type="password" name="ccpass" class="ccpass">
        <input type="submit" name="submit1" value="SAVE" class="asbut3">
    </form>
</div>
</body>
</html>

