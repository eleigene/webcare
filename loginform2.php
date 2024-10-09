<?php
    session_start();
    include "connection.php";

if (isset($_POST['submit1'])) {
    // $sql = "select * from user_info";
    // $sql_run = mysqli_query($con, $sql);
    // $sql_runs = mysqli_fetch_assoc($sql_run);
    // $ro = $sql_runs['User_Password'];
    // $password = password_hash($_POST['txtpass'], PASSWORD_DEFAULT);
    // $password1 = password_hash($ro, PASSWORD_DEFAULT);

    if (!empty(trim($_POST['username'])) && !empty(trim($_POST['password']))) {
    // if ($_POST['txtuser'] && password_verify($password, $password1)) {
        $email = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Add code to check if the account is blocked
        $check_block_query = "SELECT * FROM customer WHERE username='$email' AND blocked=1 LIMIT 1";
        $check_block_query_run = mysqli_query($con, $check_block_query);
        if (mysqli_num_rows($check_block_query_run) > 0) {
            echo "<script>
                    alert('Your account is blocked. Please wait for admin approval.');
                    window.location.href='loginform1.php';
                    </script>";
            exit(0);
        }

        $login_query = "SELECT * FROM customer WHERE username='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);
        $login_admin_query = "SELECT * FROM admin WHERE username='$email' AND password='$password' LIMIT 1";
        $login_admin_query_run = mysqli_query($con, $login_admin_query);

        if (mysqli_num_rows($login_query_run) > 0) {
            $row = mysqli_fetch_array($login_query_run);
            if ($row['verify_status'] == "Verify") {
                $_SESSION['aunthenticated'] = true;
                $_SESSION['auth_user'] = ['ID' => $row['Customer_ID'], 'FullName' => $row['fullname'], 'UserName' => $row['username'], 'Email' => $row['email'], 'Mobile' => $row['number'], 'Password' => $row['password'], 'ProfilePic' => $row['profile'], 'Status' => $row['verify_status']];
				
				header("Location: userhome.php");
			}
            elseif($row['verify_status'] == "Block"){
                echo "<script>
                    alert('Your account is currently blocked. Please wait for the administrator.');
                    window.location.href='loginform1.php';
                    </script>";
                exit(0);
            } else {
                echo "<script>
                    alert('Please verify your email address in order to access your account.');
                    window.location.href='loginform1.php';
                    </script>";
                exit(0);
            }
        } elseif (mysqli_num_rows($login_admin_query_run) > 0) {$username = $_POST['username'];
            $password = $_POST['password'];
            
            $sql = mysqli_query($con, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
            $result = mysqli_num_rows($sql);
            
            if (empty($username) || empty($password)){
                echo "<script>
                    alert('Please fill out all the fields.');
                    window.location.href='loginform1.php';
                    </script>";
            exit(0);
            }
            else if ($result === 1){
                $row = mysqli_fetch_assoc($sql);
                if ($row['username'] === $username && $row['password'] === $password){
                    $_SESSION['loggedinid'] = $row['Admin_ID'];
                    header("Location: dashboard.php");
                     exit();
                }
            }
            else if($result === 0){
                echo "<script>
                    alert('Incorrect username or password');
                    window.location.href='loginform1.php';
                    </script>";
            exit(0);
                }
        } else {
            // Add code to update login attempts and block the account if necessary
            $update_attempts_query = "UPDATE customer SET login_attempts = login_attempts + 1 WHERE username='$email'";
            mysqli_query($con, $update_attempts_query);

            $get_attempts_query = "SELECT login_attempts FROM customer WHERE username='$email'";
            $get_attempts_query_run = mysqli_query($con, $get_attempts_query);
            $attempts_row = mysqli_fetch_assoc($get_attempts_query_run);
            $remaining_attempts = 3 - $attempts_row['login_attempts'];

            if ($remaining_attempts <= 0) {
                // // Block the account
                // $block_account_query = "UPDATE user_info SET blocked = 1 WHERE User_Username='$email'";
                // mysqli_query($con, $block_account_query);
                // Block the account and update verify_status
                $block_account_query = "UPDATE customer SET blocked = 1, verify_status = 'Block' WHERE username=?";
                $block_account_stmt = mysqli_prepare($con, $block_account_query);
                mysqli_stmt_bind_param($block_account_stmt, "s", $email);
                mysqli_stmt_execute($block_account_stmt);

                echo "<script>
                        alert('Incorrect username or password. Your account is temporarily blocked, please wait for approval from the admin.');
                        window.location.href='loginform1.php';
                        </script>";
                exit(0);

                echo "<script>
                        alert('Incorrect username or password. Your account is temporarily blocked, please wait for approval from the admin.');
                        window.location.href='loginform1.php';
                        </script>";
                exit(0);
            } else {
                echo "<script>
                        alert('Incorrect username or password. You have $remaining_attempts attempt/s left.');
                        window.location.href='loginform1.php';
                        </script>";
                exit(0);
            }
        }
    } else {
        echo "<script>
                alert('Please fill out all the fields.');
                window.location.href='loginform1.php';
                </script>";
        exit(0);
    }
}

if(isset($_POST['submit2'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = mysqli_query($con, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
		$result = mysqli_num_rows($sql);
		
		if (empty($username) || empty($password)){
			echo "<script>
                alert('Please fill out all the fields.');
                window.location.href='loginform1.php';
                </script>";
        exit(0);
		}
		else if ($result === 1){
			$row = mysqli_fetch_assoc($sql);
			if ($row['username'] === $username && $row['password'] === $password){
				$_SESSION['loggedinid'] = $row['Admin_ID'];
				header("Location: dashboard.php");
				 exit();
			}
		}
		else if($result === 0){
			echo "<script>
                alert('Incorrect username or password');
                window.location.href='loginform1.php';
                </script>";
        exit(0);
			}
	}
?>