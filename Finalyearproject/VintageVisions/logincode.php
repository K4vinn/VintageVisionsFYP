<?php
session_start();
include "./Config/Database.php";

if (isset($_POST['login_now_btn'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if (mysqli_num_rows($login_query_run) > 0) {
            $row = mysqli_fetch_array($login_query_run);
            // echo $row['verify_status'];
            if ($row['verify_status'] == "1") {
                $_SESSION['authorized'] = true;
                $_SESSION['auth_user'] = [
                    'username' => $row['name'],
                    'email' => $row['email'],
                    'user_id' => $row['user_id'],
                ];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];

                $_SESSION['status'] = "You are now logged in!";
                header("Location: ./Vintage Visions/account.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Please verify your email!";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Invalid Email or Password. Please re-check the fields!";
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "All fields are required to be filled";
        header("Location: login.php");
        exit(0);
    }
} else {
}
