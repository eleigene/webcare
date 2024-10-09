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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="home.css">
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
    </style>
</head>
<body>
<div class="hd1">
    <img class="logo" src="logo.png" alt="Logo">
    <div class="nav-links">
        <a href="javascript:void(0);" class="ht1" id="openLoginModal">Sign in</a>
        <a href="#asd" class="ht2">What We Offer</a>
        <a href="about.php" class="ht3">About</a>
        <a href="home.php" class="ht4">Home</a>
    </div>
    <button class="hb1" id="openSignupModal">Register</button>
</div>
    <div class="hd2"></div>
    <div class="hd3">
        <img class="hi2" src="images/image2.png">
        <img class="hi1" src="images/image1.png">
    </div>
    <div class="hd4">
        <p class="ph1">Explore Blog Articles</p>
        <div class="acontent">
            <?php
            if (count($topArticles) > 0) {
                foreach ($topArticles as $article) {
                    $title = htmlspecialchars($article['title']);
            ?>
                    <div class="abox">
                        <div class="atitle"><?= $title ?></div>
                        <a class="learn" href="redirect.php?articleid=<?= $article['articleid'] ?>&url=<?= urlencode($article['link']) ?>">Learn more</a>
                    </div>
            <?php
                }
            } else {
                // No articles found message
                echo "<p>No articles found.</p>";
            }
            ?>
        </div>
        <a href="javascript:void(0);" id="readMoreLoginModal" class="hb2">Read more</a>
    </div>
    <div class="hd5">
        <p class="hp2" id="asd">What We Offer</p>
        <img class="hi3" src="images/wwo1.png">
        <img class="hi4" src="images/wwo2.png">
        <img class="hi5" src="images/wwo3.png">
    </div>

    <!-- Login Modal -->
    <div class="modal" id="loginModal" style="display: <?php echo isset($_SESSION['error']) && $_SESSION['last_modal'] === "login" ? 'flex' : 'none'; ?>;">
        <div class="modal-content">
            <span class="close" id="closeLoginModal">&times;</span>
            <div class="wrapper">
                <div class="title-text">
                    <div class="title login">Login Form</div>
                </div>
                <div class="form-container">
                    <div class="form-inner">
                        <form class="login" method="POST" action="login.php">
                            <div class="field">
                                <input type="text" name="username" placeholder="Username" required>
                            </div>
                            <div class="field">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="pass-link">
                                <a href="#" class="fp">Forgot password?</a>
                            </div>
                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" name="submit" value="Login">
                            </div>
                            <div class="signup-link">
                                Don't have an account? <a href="" id="openSignupFromLogin">Signup now</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Error message display -->
                <?php if (isset($_SESSION['error']) && $_SESSION['last_modal'] === "login"): ?>
                    <div class="error-message"><?php echo $_SESSION['error']; ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?> 
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <div class="modal" id="signupModal" style="display: <?php echo isset($_SESSION['error']) && $_SESSION['last_modal'] === "signup" ? 'flex' : 'none'; ?>;">
        <div class="modal-content">
            <span class="close" id="closeSignupModal">&times;</span>
            <div class="wrapper">
                <div class="title-text">
                    <div class="title signup">Signup Form</div>
                </div>
                <div class="form-container">
                    <div class="form-inner">
                        <form action="home.php" class="signup" method="POST">
                            <div class="field">
                                <input type="text" name="username" placeholder="Username" required>
                            </div>
                            <div class="field">
                                <input type="text" name="email" placeholder="Email Address" required>
                            </div>
                            <div class="field">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="field">
                                <input type="password" name="cpassword" placeholder="Confirm password" required>
                            </div>
                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" name="signup_submit" value="Signup">
                            </div>
                            <div class="login-link">
                                Already have an account? <a href="" id="openLoginFromSignup">Login now</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Error message display -->
                <?php if (isset($_SESSION['error']) && $_SESSION['last_modal'] === "signup"): ?>
                    <div class="error-message"><?php echo $_SESSION['error']; ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?> 
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
</body>
</html>
