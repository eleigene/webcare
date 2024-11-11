<?php
session_start();
include "connection.php";

if (isset($_POST['submit'])) {
    if (!empty(trim($_POST['username'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Validate user
        $login_query = "SELECT * FROM user WHERE username='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);
        $login_admin_query = "SELECT * FROM admin WHERE username='$email' AND password='$password' LIMIT 1";
        $login_admin_query_run = mysqli_query($con, $login_admin_query);

        if (mysqli_num_rows($login_query_run) > 0) {
            $row = mysqli_fetch_array($login_query_run);
            if ($row['verify_status'] == "Verify") {
                $_SESSION['authenticated'] = true;
                $_SESSION['auth_user'] = [
                    'ID' => $row['userid'],
                    'UserName' => $row['username'],
                    'Email' => $row['email'],
                    'Password' => $row['password'],
                    'ProfilePic' => $row['profile'],
                    'Status' => $row['verify_status']
                ];

                header("Location: userindex.php");
                exit();
            } else {
                $_SESSION['last_modal'] = "login";
                $_SESSION['error'] = "Please verify your email address in order to access your account.";
                header("Location: index.php");
                exit();
            }
        } elseif (mysqli_num_rows($login_admin_query_run) > 0) {
            $row = mysqli_fetch_assoc($login_admin_query_run);
            $_SESSION['loggedinid'] = $row['adminid'];
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['last_modal'] = "login";
            $_SESSION['error'] = "Incorrect username or password.";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['last_modal'] = "login";
        $_SESSION['error'] = "Please fill out all the fields.";
        header("Location: index.php");
        exit();
    }
}
