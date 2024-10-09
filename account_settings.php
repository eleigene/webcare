<?php
include("connection.php");
session_start();

$userid = $_SESSION['auth_user']['ID']; // Logged-in user's ID

// Fetch user details for the logged-in user only
$sql = "SELECT username, email, profile, userid FROM user WHERE userid = '$userid'";
$result = mysqli_query($con, $sql);

$user = [];
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result); // Fetch user data into associative array
} else {
    echo "Error fetching user details: " . mysqli_error($con);
}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Update username and email
        $username = mysqli_real_escape_string($con, $_POST['uname']);
        $email = mysqli_real_escape_string($con, $_POST['fname']); // Assuming email is in 'fname'

        // Handle file upload
        $name = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];

        if ($name) {
            $location = "upload/$name";
            move_uploaded_file($tmp_name, $location);

            // Update both profile picture and username
            $sql = "UPDATE user SET profile = '$location', username = '$username', email = '$email' WHERE userid = $userid";
        } else {
            // If no file is uploaded, just update the username and email
            $sql = "UPDATE user SET username = '$username', email = '$email' WHERE userid = $userid";
        }

        if (mysqli_query($con, $sql)) {
            echo "<script>
                alert('Updated Successfully!');
                location.href='settings.php';
            </script>";
        } else {
            echo "<script>
                    alert('Error updating! " . mysqli_error($con) . "');
                    location.href='settings.php';
                </script>";
        }
    }

    if (isset($_POST['cancel'])) {
        header("Location: userhome.php"); // Redirect back to the settings page
        exit;
    }
}
?>