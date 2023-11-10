<?php
session_start();

unset($_SESSION['authorized']);
unset($_SESSION['auth_user']);

$_SESSION['status'] = "You have been logged out!";
header('Location:../login.php');
?>