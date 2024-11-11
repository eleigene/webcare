<?php
include("connection.php");
session_start();

// Fetch the logged-in user's ID and username
$userID = $_SESSION['auth_user']['UserName'];
$userid = $_SESSION['auth_user']['ID']; // Fixed typo
if (!isset($_SESSION['auth_user'])) {
    echo "<script>alert('Please log in first.'); window.location.href = 'index.php';</script>";
    exit(); // Ensure that the rest of the page does not load
}
// Set default values for the user details
$first1 = "Unknown User"; // Default value if no result is found
$two1 = "No email found"; // Default value if no result is found
$six1 = "default_profile.jpg"; // Default profile image if not found

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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .account-info {
            margin-top: 20px;
            padding: 10px;
        }

        .account-info p {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }

        .account-info span {
            font-weight: bold;
            color: #333;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Account Details</h1>

        <div class="account-info">
            <p class="asp6">Username: <?php echo htmlspecialchars($first1); ?></p>
            <p class="asp6">Email: <?php echo htmlspecialchars($two1); ?></p>

            <img src="<?php echo htmlspecialchars($six1); ?>"

                style="width: 50px; height: 50px; border-radius: 50%; margin-left: 10px;">
        </div>

        <div class="btn-container">
            <button class="btn" onclick="window.location.href='settings.php'">Edit Account</button>
        </div>
    </div>

</body>

</html>