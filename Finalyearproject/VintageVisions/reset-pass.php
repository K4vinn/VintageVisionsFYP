<?php
session_start();
include "../VintageVisions/Database.php";
$isAuthorized = isset($_SESSION['authorized']);
?>

<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../VintageVisions/Style/NavigationLogin.css" />
    <link rel='stylesheet' href='../VintageVisions/Style/Reset.css' />

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


<body>

    <div class="reset-pass-container">
        <div>
            <h1 class='resetpassnow'> Reset your password </h1>
            <h3 class='text2'> Oh no! Seems like you've forgotten your password!</h3>
            <h3 class='text2'> Not to worry, reset it now!</h3>
        </div>
        <div id="vertical-line"></div>
        <div class="resetp">
            <form class="resetp" action="password-reset-code.php" method="post" autocomplete="off">

                <input class="inputreset" type="text" name="email" id="email" placeholder="Email" required value=""> <br />

                <button class="buttonreset" type="submit" name="password_reset_link"> Reset </button>
            </form>
        </div>

        <div>
            <?php
            if (isset($_SESSION['success'])) {
            ?>
                <div>
                    <h5 class='status-success'> <?= $_SESSION['success']; ?> </h5>
                </div>
            <?php
                unset($_SESSION['success']);
            }
            ?>
        </div>

        <div>
            <?php
            if (isset($_SESSION['status'])) {
            ?>
                <div>
                    <h5 class='status-reset'> <?= $_SESSION['status']; ?> </h5>
                </div>
            <?php
                unset($_SESSION['status']);
            }
            ?>
        </div>
    </div>

    <div class='resetb'>
        <hr class='resetline' />
        <br />
        <h3 class='text3'> Don't want to change? Return now.</h3>
        <button class="resetback" onclick="window.location.href = 'login.php';"> Return Now! </button>
    </div>
    </div>
</body>

</html>