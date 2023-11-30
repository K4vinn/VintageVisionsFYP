<?php
session_start();
$page_title = "Password Update";
$isAuthorized = isset($_SESSION['authorized']);

?>

<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../VintageVisions/Style/NavigationLogin.css" />
    <link rel='stylesheet' href='../VintageVisions/Style/reset.css' />

    <script src='../Scripts/home.js'></script>
    <script src="https://js.stripe.com/v3/"></script>


    <title>Vintage Visions</title>
</head>

<header>
    <div class="newest">
        <!-- Background design -->
        <div class="layer-2"></div>
        <!-- Title -->
        <div class="navbar">
            <div class="navbar-title">Vintage Visions</div>
            <a href="../VintageVisions/Vintage%20Visions/home.php" class="navbar-link homepage">Home</a>
            <a href="../VintageVisions/Vintage%20Visions/about.php" class="navbar-link aboutpage">About</a>
            <a href="../VintageVisions/Vintage%20Visions/support.php" class="navbar-link supportpage">Support</a>
            <a href="../VintageVisions/Vintage%20Visions/catalogue.php" class="navbar-link cataloguepage">Catalogue</a>
            <?php if (!$isAuthorized) { //Check if the user is not authorized
                echo '<a href="../VintageVisions/Vintage%20Visions/cart.php" style="left: 1680px;" class="navbar-link cartpage">Cart - 0</a>
        <a href="../VintageVisions/Vintage%20Visions/account.php" style="left: 1530px;" class="navbar-link accountpage">Account</a>';
            } else {
                echo '<a href="../VintageVisions/Vintage%20Visions/cart.php" style="left: 1640px;" class="navbar-link cartpage">Cart</a>
        <a href="../VintageVisions/Vintage%20Visions/account.php" style="left: 1490px;" class="navbar-link accountpage">Account</a>
        <a style="left: 1730px;" class="navbar-link logout" href="logout.php">Logout</a>';
            }
            ?>
        </div>
</header>

<div class="reset-form-css">

    <?php
    if (isset($_SESSION['status'])) {
    ?>
        <div class="alert alert-success">
            <h5> <?= $_SESSION['status']; ?> </h5>
        </div>
    <?php
        unset($_SESSION['status']);
    }
    ?>

    <form class="login" action="password-reset-code.php" method="post" autocomplete="off">
        <input type='hidden' name="password_token" value="<?php if (isset($_GET['token'])) {
                                                                echo $_GET['token'];
                                                            } ?>">

        <input class="inputr" type="text" name="email" id="email" placeholder="Email" required value="<?php if (isset($_GET['email'])) {
                                                                                                            echo $_GET['email'];
                                                                                                        } ?>"> <br />

        <input class="inputr" type="password" name="new_password" id="password" placeholder="Password" required value=""> <br />

        <input class="inputr" type="password" name="confirm_password" id="confirmpassword" placeholder="Confirm Password" required value=""> <br />

        <button class="buttonr" type="submit" name="password_update"> Update Now! </button>
    </form>
</div>
</div>
</body>

</html>