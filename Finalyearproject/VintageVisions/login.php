<?php
session_start();
include "../VintageVisions/Database.php";

if (isset($_SESSION['authorized'])) {
    $_SESSION['status'] = "You are already logged in! Welcome to the dashboard.";
    header('Location: ./Vintage Visions/account.php');
    exit(0);
}


$isAuthorized = isset($_SESSION['authorized']);

$page_title = "Login ";
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../VintageVisions/Style/NavigationLogin.css" />
    <link rel='stylesheet' href='../VintageVisions/Style/Login.css' />

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
    <div>

        <div class='welcome'>
            <h2 class='signuptoday'> Welcome to the Club!</h2>
            <h3 class='text2'> Tune into the vintage culture to be greeted </h3>
            <h3 class='text3'> with some welcoming gifts and member benefits! </h3>

            <h3 class='text4'> New here? Register now! </h3>
            <button class="button2" onclick="window.location.href = 'registration.php';"> Register </button>
        </div>

        <div id="vertical-line"></div>

        <div class='login-form-container'>
            <form class="login" action="logincode.php" method="post" autocomplete="off" onsubmit="return validateLoginForm()">
                <input class="inputl" type="text" name="email" id="email" placeholder="Email" required>
                <div id="emailError" style="color: black; text-align: center;"></div>

                <input class="inputl" type="password" name="password" id="pass" placeholder="Password" required>
                <div id="passwordError" style="color: black; text-align: center;"></div>

                <button class="buttonl" type="submit" name="login_now_btn">Login</button>
            </form>

        </div>
        <p class='forgot'> Forgotten your password? Don't worry, reset here now!<a href="reset-pass.php" class='reset'> Reset Now</a> </p>
    </div>
    </div>
    <?php
    if (isset($_SESSION['status'])) {
    ?>
        <div>
            <h5 class='status-text2'> <?= $_SESSION['status']; ?> </h5>
        </div>
    <?php
        unset($_SESSION['status']);
    }
    ?>
</body>

<script>
    function validateLoginForm() {
        // Reset any previous error messages
        document.getElementById('emailError').textContent = '';
        document.getElementById('passwordError').textContent = '';

        // Get form field values
        const email = document.getElementById('email').value;
        const password = document.getElementById('pass').value;

        // Regular expression for validating email format
        const emailPattern = /^\S+@\S+\.\S+$/;

        let isValid = true;

        if (!email.match(emailPattern)) {
            document.getElementById('emailError').textContent = 'Invalid email format.';
            isValid = false;
        }

        if (password.trim() === '') {
            document.getElementById('passwordError').textContent = 'Password is required.';
            isValid = false;
        }

        if (password.length < 8) {
            document.getElementById('passwordError').textContent = 'Password must be at least 8 characters.';
            isValid = false;
        }

        return isValid;
    }
</script>

</html>