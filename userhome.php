<?php
include("connection.php");
session_start();
if (!isset($_SESSION['auth_user'])) {

    exit(); // Ensure that the rest of the page does not load
}
if (isset($_SESSION['login_success'])) {

    unset($_SESSION['login_success']);
}
$userID = $_SESSION['auth_user']['UserName'];
$userid = $_SESSION['auth_user']['ID']; // Fixed typo

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
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="home.css"> -->
    <!-- <link rel="stylesheet" href="userhome.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Seymour+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Abril+Fatface' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Alice' rel='stylesheet'>
    <title>Slideshow Example</title>
    <style>
        .float-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 70px;
            /* Adjust width as needed */
            height: 70px;
            /* Adjust height as needed */
            cursor: pointer;
            background-color: rgba(208, 212, 202, 0.4);
            border-radius: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            z-index: 200;
        }

        .float-button img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image fills the button without stretching */

        }

        .float-button1 {
            position: fixed;
            bottom: 110px;
            right: 30px;
            width: 70px;
            /* Adjust width as needed */
            height: 70px;
            /* Adjust height as needed */
            background-color: rgba(208, 212, 202, 0.4);
            border-radius: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            z-index: 200;
        }

        .float-button1 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image fills the button without stretching */
        }

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


        .dropdown-center {
            position: relative;
        }

        @media (min-width: 768px) {
            #profileDropdownLinks {
                position: absolute;
                left: -100px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid m-0 p-0">

        <!-- RESPONSIVE NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 shadow">
            <a class="navbar-brand" href="#">
                <img src="logo.png" width="50" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav text-center d-flex justify-content-center align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="userhome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#abt">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#asd">What We Offer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resources.php">Resources</a>
                    </li>
                    <!-- User Profile Dropdown -->
                    <div class="dropdown-center">
                        <div class="mx-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-5" src="<?php echo htmlspecialchars($six1); ?>" width="40" height="40">
                        </div>
                        <ul class="dropdown-menu" id="profileDropdownLinks">
                            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>

                </ul>
            </div>
        </nav>

        <!-- 2ND SECTION -->
        <div class="container-fluid p-0">
            <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="1500">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/ss1.png" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="images/ss2.png" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="images/ss3.png" class="d-block w-100">
                    </div>
                </div>
                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>


        <!-- 3RD SECTION -->
        <div id="abt" class="container-fluid bg-success-subtle py-4">
            <div class="container text-center">
                <p class="fs-2 fw-bold text-success py-2">WEBCARE</p>
                <p class="py-2 fw-medium text-body-secondary">This checklist lists various symptoms related to your mental health. Check the box next to each symptom that matches what you’re experiencing. Once you finish, you'll receive personalized recommendations based on your responses. Your answers and results are confidentials.</p>
            </div>
        </div>

        <!-- 4TH SECTION -->
        <div class="container">
            <p id="asd" class="text-center fs-2 fw-bold text-success mt-4">What We Offer</p>
            <div class="d-flex flex-column justify-content-center align-items-center overflow-hidden">
                <img class=" border-primary img-fluid" src="images/wwo1.png">
                <img class=" border-primary img-fluid" src="images/wwo2.png">
                <img class=" border-primary img-fluid" src="images/wwo3.png">
            </div>
        </div>

        <!-- FLOATING ICONS -->
        <a href="http://127.0.0.1:5000/" class="float-button">
            <img src="images/m1.png">
        </a>
        <a href="checklist.php" class="float-button1">
            <img src="images/m2.png">
        </a>
    </div>

    <!-- Bootstrap 5.3 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>