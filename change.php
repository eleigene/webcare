<?php
// Include your database connection file here
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "webcaredb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    $adminid = $_POST['adminid']; // Get the admin ID
    $new_username = $_POST['fname']; // Get the new username from the form

    // Sanitize the input
    $new_username = $conn->real_escape_string($new_username);

    // Prepare and execute the UPDATE statement
    $sql = "UPDATE admin SET username = '$new_username' WHERE adminid = '$adminid'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>location.href='admin-setting.php';
    </script>";
    } else {
        echo "Error updating username: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
