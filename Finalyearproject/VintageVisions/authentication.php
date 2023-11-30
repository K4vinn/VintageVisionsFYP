<?php
// session_start();

if (!isset($_SESSION['authorized'])) {
    $_SESSION['status'] = "Please Login to Access Accounts";
    header('Location: ../login.php');
    exit(0);
}
