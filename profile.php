<?php
include("connection.php");
session_start();

// Fetch the logged-in user's ID and username
$userID = $_SESSION['auth_user']['UserName'];
$userid = $_SESSION['auth_user']['ID']; // Fixed typo
if (!isset($_SESSION['auth_user'])) {
    echo "<script>alert('Please log in first.'); window.location.href = 'home.php';</script>";
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
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* Additional styles specific to this page if needed */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .logo {
            width: 50px;
            /* Adjust as needed */
            height: auto;
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
        }

        .fieldsContainer {
            width: 100%;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .fieldsContainer {
                width: 50%;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid vh-100 m-0 p-0">
        <div class="bg-success-subtle text-success text-center fs-1 fw-bold py-4">Account Details</div>
        <div class="container mt-4 rounded-3">
            <img src="<?php echo htmlspecialchars($six1); ?>" width="300" height="250" class="rounded mx-auto mb-4 d-block border shadow-sm object-fit-cover">

            <div class="fieldsContainer mb-3">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" type="text" placeholder="Disabled input" id="username" name="username" aria-label="Disabled input example" disabled value="<?php echo htmlspecialchars($first1); ?>">
            </div>

            <div class="fieldsContainer mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="text" placeholder="Disabled input" id="email" name="email" aria-label="Disabled input example" disabled value="<?php echo htmlspecialchars($two1); ?>">
            </div>


            <div class="d-flex justify-content-center">
                <button class="btn btn-success" onclick="window.location.href='settings.php'">Edit Account</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>