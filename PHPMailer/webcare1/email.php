<?php
session_start();
include "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\webcare\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\webcare\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\webcare\PHPMailer\src\SMTP.php';

function sendemail_verify($name, $email, $verify_token){
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'webcarecounseling@gmail.com';           // SMTP username
        $mail->Password   = 'lbitriptbjiqwpmp';                     // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable SSL encryption
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('webcarecounseling@gmail.com', 'WebCare Counseling Platform');
        $mail->addAddress($email, $name);                           // Add a recipient

        //Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Email Verification from WebCare';
        $mail->Body    = "
            <h2>You have Registered with WebCare</h2>
            <p>Please click the following link to verify your email:</p>
            <a href='http://localhost/webcare/verify.php?token=$verify_token'>Verify Email</a>
        ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';  // Plain text alternative for non-HTML mail clients

        $mail->send();
        // echo '<script>alert("Message has been sent")</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if(isset($_POST['submit'])){
    $duplicate = mysqli_query($con, "SELECT * FROM user WHERE username = '$_POST[username]'");
    if(mysqli_num_rows($duplicate) > 0){
        echo '<script>alert("This username is already taken.");
              window.location.href="home.php";</script>';
    } else {
        if($_POST["password"] == $_POST["cpassword"]){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $verify_token = md5(rand());
            $password = $_POST['password'];

            $check_email_query = "SELECT email FROM user WHERE email='$email' LIMIT 1";
            $check_username_query = "SELECT username FROM user WHERE username='$username' LIMIT 1";
            $check_email_query_run = mysqli_query($con, $check_email_query);
            $check_username_query_run = mysqli_query($con, $check_username_query);

            if(mysqli_num_rows($check_email_query_run) > 0){
                echo '<script>alert("This email has been used already.");
                      window.location.href="home.php";</script>';
            }

            if(mysqli_num_rows($check_username_query_run) > 0){
                echo '<script>alert("This username has been used already.");
                      window.location.href="home.php";</script>';
            } else {
                $query = "INSERT INTO user (username, email, password, verify_token, profile,verify_status) VALUES ('$username', '$email', '$password', '$verify_token', 'profile.jpg','Not Verify')";
                $query_run = mysqli_query($con, $query);

                if($query_run){
                    sendemail_verify($username, $email, $verify_token);
                    echo '<script>
                        alert("Registration Successfull.! Please verify your Email Address.");
                        window.location.href="home.php";
                      </script>';
                } else {
                    echo '<script>alert("Registration Failed");
                          window.location.href="home.php";</script>';
                }
            }
        } else {
            echo '<script>alert("Password does not match.");
                  window.location.href="home.php";</script>';
        }
    }
}
?>
