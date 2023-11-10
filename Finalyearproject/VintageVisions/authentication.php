<?php 
session_start();

if (!isset($_SESSION['authorized']))
{
    $_SESSION['status'] = "Please Login to access dashboard";
    header('Location: ../login.php');
    exit(0);
}
