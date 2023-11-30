<?php
include("../Config/Database.php");
session_start();
$isAuthorized = isset($_SESSION['authorized']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Style/Navigation.css" />
    <link rel='stylesheet' href='../Style/footer.css' />
    <link rel="stylesheet" href="../Style/test.css" />
    <link rel='stylesheet' href='../Style/Catalogue.css' />
    <link rel='stylesheet' href='../Style/about.css' />
    <link rel='stylesheet' href='../Style/Support.css' />
    <link rel='stylesheet' href='../Style/Account.css' />
    <link rel='stylesheet' href='../Style/Products.css' />
    <link rel='stylesheet' href='../Style/cart.css' />
    <link rel='stylesheet' href='../Style/Wishlist.css' />
    <link rel='stylesheet' href='../Style/accountedit.css' />

    <script src='../Scripts/home.js'></script>
    <script src="https://js.stripe.com/v3/"></script>


    <title>Vintage Visions</title>
</head>

<header>
    <div class="newest">
        <div class="layer-2"></div>
        <div class="navbar">
            <div class="navbar-title">Vintage Visions</div>
            <a href="../Vintage Visions/home.php" class="navbar-link homepage">Home</a>
            <a href="../Vintage Visions/about.php" class="navbar-link aboutpage">About</a>
            <a href="../Vintage Visions/support.php" class="navbar-link supportpage">Support</a>
            <a href="../Vintage Visions/catalogue.php" class="navbar-link cataloguepage">Catalogue</a>
            <?php if (!$isAuthorized) { //Check if the user is not authorized
                echo '<a href="../Vintage Visions/cart.php" style="left: 1680px;" class="navbar-link cartpage">Cart - 0</a>
        <a href="../Vintage Visions/account.php" style="left: 1530px;" class="navbar-link accountpage">Account</a>';
            } else {
                echo '<a href="../Vintage Visions/cart.php" style="left: 1640px;" class="navbar-link cartpage">Cart</a>
        <a href="../Vintage Visions/account.php" style="left: 1490px;" class="navbar-link accountpage">Account</a>
        <a style="left: 1730px;" class="navbar-link logout" href="logout.php">Logout</a>';
            }
            ?>
        </div>
</header>

<body>