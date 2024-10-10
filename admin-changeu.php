<?php
session_start();
include "connect.php";

$userId = $_SESSION['auth_user']['ID'];
$current_password = $_SESSION['auth_user']['Password'];

if (isset($_POST['submit1'])) {
    $old = mysqli_real_escape_string($con, $_POST['cpass']);
    $new = mysqli_real_escape_string($con, $_POST['npass']);
    $new2 = mysqli_real_escape_string($con, $_POST['ccpass']);

    if (!empty($old) && !empty($new) && !empty($new2)) {
        // Checking if old password is valid
        $check_token = "SELECT password FROM admin WHERE adminid='$userId' AND password='$old' LIMIT 1"; // Updated to correct table name and column
        $check_token_run = mysqli_query($con, $check_token);

        if (mysqli_num_rows($check_token_run) > 0) {
            if ($new === $new2) {
                $update_password = "UPDATE admin SET password='$new' WHERE adminid='$userId' LIMIT 1"; // Updated to correct table name
                if (mysqli_query($con, $update_password)) {
                    // Update session password
                    $_SESSION['auth_user']['Password'] = $new;

                    echo "<script>
                        location.href='admin-setting.php';
                    </script>";
                    exit(0);
                } else {
                    echo "<script>
                        location.href='admin-setting.php';
                    </script>";
                    exit(0);
                }
            } else {
                echo "<script>
                    location.href='admin-setting.php';
                </script>";
                exit(0);
            }
        } else {
            echo "<script>
                location.href='admin-settings.php';
            </script>";
            exit(0);
        }
    } else {
        echo "<script>
            location.href='settings.php';
        </script>";
        exit(0);
    }
}
?>
