<?php
session_start();
include "./Config/Database.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token)
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
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);                                        //Set email format to HTML
    $mail->Subject = 'Email verification for Site';
    $email_template = "<h2> Hello $name, You have registered for Vintage Visions </h2>
                            <h5> Verify Email With the Link Provided Below! </h5>
                            <br/><br/>
                            <a href='localhost/Finalyearproject/verify-email.php?token=$verify_token'> Click this link to enter the verification page and confirm your account! </a>";
    $mail->Body    = $email_template;

    $mail->send();
    echo 'Message has been sent';
}


if (isset($_POST['register-btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $verify_token = md5(rand());
    echo $row['email'];

    //Email Exists or not
    $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email ID already exists";
        header("Location: registration.php");
    } else {
        //Insert User Registered User Data
        $query = "INSERT INTO users (name,email,password,verify_token) VALUES ('$name', '$email', '$hashed_password', '$verify_token')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            sendemail_verify("$name", "$email", "$verify_token");
            $_SESSION['status'] = "Registration Successful! Please verify your email address.";
            header("Location: registration.php");
        } else {
            $_SESSION['status'] = "Registration Failed";
            header("Location: registration.php");
        }
    }
}
