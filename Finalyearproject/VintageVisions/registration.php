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
    <link rel='stylesheet' href='../VintageVisions/Style/Registration.css' />

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
    <div class='reg-form'>
        <div>
            <h2 class='signuptoday'> Join Us Today </h2>
            <h3 class='text2'> Tune into the vintage culture to be greeted </h3>
            <h3 class='text3'> with some welcoming gifts and member benefits! </h3>
            <h3 class='text3'> We're excited to have you as a member of this family!</h3>
        </div>
        <div id="vertical-line"></div>
        <div>

            <form class="login" action="registercode.php" method="post" autocomplete="off" onsubmit="return validateForm()">
                <input class="inputr" type="text" name="name" id="name" placeholder="Name" required>
                <div id="nameError" style="color: black; text-align: center;"></div>

                <input class="inputr" type="text" name="email" id="email" placeholder="Email" required>
                <div id="emailError" style="color: black; text-align: center;"></div>

                <input class="inputr" type="password" name="password" id="password" placeholder="Password" required>
                <div id="passwordError" style="color: black; text-align: center;"></div>

                <input class="inputr" type="password" name="confirm-password" id="confirmPassword" placeholder="Confirm Password" required>
                <div id="confirmPasswordError" style="color: black; text-align: center;"></div>

                <button class="buttonr" type="submit" name="register-btn">Register</button>
            </form>
        </div>
    </div>
    <div>
        <?php
        if (isset($_SESSION['success'])) {
        ?>
            <div>
                <h5 class='status-text-success'> <?= $_SESSION['success']; ?> </h5>
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
                <h5 class='status-text2'> <?= $_SESSION['status']; ?> </h5>
            </div>
        <?php
            unset($_SESSION['status']);
        }
        ?>
    </div>
</body>

<script>
    function validateForm() {
        // Reset any previous error messages
        document.getElementById('nameError').textContent = '';
        document.getElementById('emailError').textContent = '';
        document.getElementById('passwordError').textContent = '';
        document.getElementById('confirmPasswordError').textContent = '';

        // Get form field values
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        // Regular expression for validating email format
        const emailPattern = /^\S+@\S+\.\S+$/;
        // Regular expression to check if name contains numbers
        const nameContainsNumbers = /\d/.test(name);

        let isValid = true;

        if (name.trim() === '') {
            document.getElementById('nameError').textContent = 'Name is required.';
            isValid = false;
        } else if (nameContainsNumbers) {
            document.getElementById('nameError').textContent = 'Name cannot contain numbers.';
            isValid = false;
        }

        if (!email.match(emailPattern)) {
            document.getElementById('emailError').textContent = 'Invalid email format.';
            isValid = false;
        }

        if (password.length < 8) {
            document.getElementById('passwordError').textContent = 'Password must be at least 8 characters.';
            isValid = false;
        }

        if (password !== confirmPassword) {
            document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
            isValid = false;
        }

        return isValid;
    }
</script>

</html>