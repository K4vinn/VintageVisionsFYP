<?php
session_start();
include "./Config/Database.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_email, $token)
{
    $mail = new PHPMailer(true);

    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nash.kavin.kd@gmail.com';              //SMTP username
    $mail->Password   = 'atdvhjftkqgqwixo';                     //SMTP password
    $mail->SMTPSecure = "ssl";                                  //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('nash.kavin.kd@gmail.com', 'Vintage Vision');
    $mail->addAddress($get_email);

    //Content
    $mail->isHTML(true);                                        //Set email format to HTML
    $mail->Subject = 'Email verification for Site';
    $email_template = "<h2> Hello! You have requested for a password change at Vintage Visions </h2>
                            <h5> A new password reset token has been sent! </h5>
                            <br/><br/>
                            <a href='localhost/Finalyearproject/password-change.php?token=$token&email=$get_email'> Change Password Now! </a>";
    $mail->Body    = $email_template;

    $mail->send();
    echo 'Message has been sent';
}


if (isset($_POST['password_reset_link'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token='$token' WHERE email = '$get_email' LIMIT 1";
        $update_token_run = mysqli_query($con, $update_token);

        if ($update_token_run) {
            send_password_reset($get_email, $token);
            $_SESSION['status'] = "An email has been sent!";
            header("Location: reset-pass.php");
            exit(0);
        } else {
            $_SESSION['status'] = "Something went wrong!";
            header("Location: reset-pass.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No email found";
        header("Location: reset-pass.php");
        exit(0);
    }
}

if (isset($_POST['password_update'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    $token = mysqli_real_escape_string($con, $_POST['password_token']);

    if (!empty($token)) {
        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {
            //Check token is valid
            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($con, $check_token);

            if (mysqli_num_rows($check_token_run) > 0) {
                if ($new_password == $confirm_password) {
                    $update_password = "UPDATE users SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
                    $update_password_run = mysqli_query($con, $update_password);

                    if ($update_password_run) {
                        $_SESSION['status'] = "New Password Updated!";
                        header("Location: login.php");
                        exit(0);
                    } else {
                        $_SESSION['status'] = "Password was not updated. Something has gone wrong!";
                        header("Location: password-change.php?token=$token&email=$email");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Password and Confirmed Password does not match";
                    header("Location: password-change.php?token=$token&email=$email");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid Token!";
                header("Location: password-change.php?token=$token&email=$email");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "All fields are mandatory!";
            header("Location: password-change.php?token=$token&email=$email");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No token available";
        header("Location: password-reset.php");
        exit(0);
    }
}
