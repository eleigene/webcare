<?php
session_start(); // Start or resume session
include "connection.php"; // Include your database connection file
if (isset($_SESSION['login_success'])) {

    unset($_SESSION['login_success']);
}

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="home.css"> -->
    <!-- <link rel="stylesheet" href="loginreg.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Seymour+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Nanum+Myeongjo' rel='stylesheet'>
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
    <!-- MAIN CONTAINER -->
    <div class="container-fluid m-0 p-0">

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
                        <a class="nav-link" href="#asd">What We Offer</a>
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

        <!-- 2ND SECTION -->
        <div class="container vh-100 d-flex flex-column flex-md-row justify-content-center align-items-center gap-4 overflow-hidden">
            <img class="hi2 img-fluid" src="images/image2.png" alt="Image 2">
            <img class="hi1 img-fluid" src="images/image1.png" alt="Image 1">
        </div>

        <!-- 3RD SECTION -->
        <div class="container-fluid bg-success-subtle">
            <div class="container d-flex flex-column">
                <p class="text-center fs-2 fw-bold text-success py-2">Explore Blog Articles</p>
                <div class="row">
                    <?php
                    if (count($topArticles) > 0) {
                        foreach ($topArticles as $article) {
                            $title = htmlspecialchars($article['title']);
                    ?>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title fw-normal text-center"><?= $title ?></h6>
                                        <div class="mt-auto d-flex justify-content-center">
                                            <a class="btn btn-outline-success btn-sm" href="redirect.php?articleid=<?= $article['articleid'] ?>&url=<?= urlencode($article['link']) ?>">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No articles found.</p>";
                    }
                    ?>
                </div>

                <a href="javascript:void(0);" id="readMoreLoginModal" class="btn btn-success btn-sm mb-3 mx-auto">Read more</a>
            </div>
        </div>

        <!-- 4TH SECTION -->
        <div class="container">
            <p class="text-center fs-2 fw-bold text-success mt-4">What We Offer</p>
            <div class="d-flex flex-column justify-content-center align-items-center overflow-hidden">
                <img class=" border-primary img-fluid" src="images/wwo1.png">
                <img class=" border-primary img-fluid" src="images/wwo2.png">
                <img class=" border-primary img-fluid" src="images/wwo3.png">
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
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="text-end">
                            <a href="#" class="text-decoration-none">Forgot password?</a>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success w-100 mt-3">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Signup now</a>
                    </div>
                    <?php if (isset($_SESSION['error']) && $_SESSION['last_modal'] === "login"): ?>
                        <div class="alert alert-danger mt-3"><?= $_SESSION['error']; ?></div>
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

    <script>
        const loginModal = document.getElementById("loginModal");
        const signupModal = document.getElementById("signupModal");
        const openLoginModal = document.getElementById("openLoginModal");
        const openSignupModal = document.getElementById("openSignupModal");
        const closeLoginModal = document.getElementById("closeLoginModal");
        const closeSignupModal = document.getElementById("closeSignupModal");
        const openSignupFromLogin = document.getElementById("openSignupFromLogin");
        const openLoginFromSignup = document.getElementById("openLoginFromSignup");
        const readMoreLoginModal = document.getElementById("readMoreLoginModal");

        openLoginModal.onclick = () => {
            loginModal.style.display = "flex";
            signupModal.style.display = "none";
        };

        openSignupModal.onclick = () => {
            signupModal.style.display = "flex";
            loginModal.style.display = "none";
        };

        closeLoginModal.onclick = () => {
            loginModal.style.display = "none";
        };

        closeSignupModal.onclick = () => {
            signupModal.style.display = "none";
        };

        window.onclick = (event) => {
            if (event.target == loginModal) {
                loginModal.style.display = "none";
            }
            if (event.target == signupModal) {
                signupModal.style.display = "none";
            }
        };

        openSignupFromLogin.onclick = (event) => {
            event.preventDefault();
            loginModal.style.display = "none";
            signupModal.style.display = "flex";
        };

        openLoginFromSignup.onclick = (event) => {
            event.preventDefault();
            signupModal.style.display = "none";
            loginModal.style.display = "flex";
        };

        // Add event listener for "Read more" link
        readMoreLoginModal.onclick = () => {
            loginModal.style.display = "flex";
            signupModal.style.display = "none";
        };
    </script>

    <!-- Bootstrap 5.3 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>