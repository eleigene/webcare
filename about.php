<?php
session_start(); // Start or resume session
include "connection.php"; // Include your database connection file

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1";
    $login_result = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_result) == 1) {
        $row = mysqli_fetch_assoc($login_result);
        $_SESSION['authenticated'] = true;
        $_SESSION['auth_user'] = [
            'ID' => $row['userid'],
            'UserName' => $row['username'],
            'Email' => $row['email'],
            'Password' => $row['password'],
            'ProfilePic' => $row['profile'],
            'Status' => $row['verify_status']
        ];
        mysqli_close($con);
        header("Location: userhome.php");
        exit();
    } else {
        $_SESSION['last_modal'] = "login";
        $_SESSION['error'] = "Incorrect username or password.";
    }
}

// Handle signup form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup_submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    // Validate if passwords match
    if ($password != $cpassword) {
        $_SESSION['last_modal'] = "signup";
        $_SESSION['error'] = "Passwords do not match.";
    } else {
        // Check if username or email already exists
        $check_user_query = "SELECT * FROM user WHERE username='$username' OR email='$email'";
        $check_user_result = mysqli_query($con, $check_user_query);

        if (mysqli_num_rows($check_user_result) > 0) {
            $_SESSION['last_modal'] = "signup";
            $_SESSION['error'] = "Username or Email already exists.";
        } else {
            // Insert user into database
            $insert_user_query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
            if (mysqli_query($con, $insert_user_query)) {
                $_SESSION['last_modal'] = "login";
                $_SESSION['success'] = "Registration successful. Please login.";
            } else {
                $_SESSION['last_modal'] = "signup";
                $_SESSION['error'] = "Error: " . mysqli_error($con);
            }
        }
    }

    mysqli_close($con);
    header("Location: home.php");
    exit();
}

// Fetch top 3 most visited articles
$topArticlesSql = "SELECT articleid, title, picture, link FROM articles ORDER BY visit_count DESC LIMIT 3";
$topArticlesResult = mysqli_query($con, $topArticlesSql);

$topArticles = [];
if ($topArticlesResult && mysqli_num_rows($topArticlesResult) > 0) {
    while ($row = mysqli_fetch_assoc($topArticlesResult)) {
        $topArticles[] = $row;
    }
} else {
    // Handle database error gracefully
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
<html>

<head>
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Freeman' rel='stylesheet'>
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
    </style>
</head>

<body>
    <div class="container-fluid p-0 m-0">
        <!-- RESPONSIVE NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 shadow-sm">
            <a class="navbar-brand" href="#">
                <img src="logo.png" width="50" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php#asd">What We Offer</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn nav-link" data-bs-toggle="modal" data-bs-target="#login_Modal" id="openLoginModal">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-success ml-lg-2" data-bs-toggle="modal" data-bs-target="#register_Modal" id="openSignupModal">Register</button>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <p class="text-center fs-2 fw-bold text-success py-2 mt-3">ABOUT US</p>
            <div class="container d-flex flex-column flex-md-row justify-content-center align-items-center gap-4 overflow-hidden">
                <img class="img-fluid" src="images/image3.png">
                <img class="img-fluid" src="images/image4.png">
            </div>
        </div>

        <div class="container-fluid bg-success-subtle">
            <p class="text-center fs-2 fw-bold text-success pt-4">OUR MISSION</p>
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2 overflow-hidden py-4">
                <img class="img-fluid" src="images/image5.png">
                <img class="img-fluid" src="images/image6.png">
            </div>
        </div>

        <!-- Section 4 -->
        <div class="container-fluid">
            <p class="text-center fs-2 fw-bold text-success pt-4">OUR VISION</p>
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2 overflow-hidden py-4">
                <img class="img-fluid" src="images/image7.png">
                <img class="img-fluid" src="images/image8.png">
            </div>
        </div>
    </div>


    <!-- Login Modal -->
    <div class="modal fade" id="login_Modal" tabindex="-1" aria-labelledby="login_ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="login" method="POST" action="loginabout.php">
                        <div class="mb-3">
                            <input class="form-control" type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="text-end">
                            <a href="#" class="text-decoration-none">Forgot password?</a>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success w-100 mt-3">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Signup now</a>
                    </div>
                    <!-- Error message display -->
                    <?php if (isset($_SESSION['error']) && $_SESSION['last_modal'] === "login"): ?>
                        <div class="error-message"><?php echo $_SESSION['error']; ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <div class="modal fade" id="register_Modal" tabindex="-1" aria-labelledby="register_ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Signup Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input class="form-control" type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="password" name="password" placeholder="Password" required minlength="6">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required minlength="6">
                        </div>
                        <?php
                        if (isset($alert)) {
                            foreach ($alert as $alert) {
                                echo '<div class="alert">' . $alert . '</div>';
                            }
                        }
                        ?>

                        <button type="submit" name="submit" class="btn btn-success w-100 mt-3" formaction="email.php">Register</button>
                        <div class="mt-4 text-center">
                            Already have an account? <a href="" id="openLoginFromSignup">Login now</a>
                        </div>
                    </form>
                    <!-- Error message display -->
                    <?php if (isset($_SESSION['error']) && $_SESSION['last_modal'] === "signup"): ?>
                        <div class="error-message"><?php echo $_SESSION['error']; ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5.3 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>