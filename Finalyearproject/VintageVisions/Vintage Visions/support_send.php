<?php
session_start();
include "../Config/Database.php";

if (isset($_SESSION["authorized"])) {
    $email = $_SESSION['email'];
}

if (isset($_POST['support_send'])) {
    $supportemail = $_POST['email'];
    $supportsubject = $_POST['subject'];
    $supportmessage = $_POST['message'];

    $sendsupport = "INSERT INTO `support` (`support_email`, `support_subject`, `support_message`) VALUES ('$supportemail', '$supportsubject', '$supportmessage')";
    $sendsupportrun = mysqli_query($con, $sendsupport);

    if ($sendsupportrun) {
        $_SESSION['status'] = "Support message has been sent!";
    } else {
        $_SESSION['status'] = "Support message had an error, try again later.";
    }

    header("Location: support.php");
    exit();
}
