<?php
session_start();
include "./Config/Database.php";
if (isset($_SESSION['authorized'])) {
    $_SESSION['status'] = "You are already logged in! Welcome to the dashboard.";
    header('Location: ./Vintage Visions/account.php');
    exit(0);
}

$page_title = "Login Form";
?>

<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="./Style/Home.css">
    <link rel="stylesheet" href="./Style/Login.css">
    <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <header>
        <div class='navbar'>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Catalogue</a></li>
                    <li><a href="#">Support</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </nav>
        </div>

        <div class='title'>
            <h1> Vintage Visions</h1>
        </div>

        <div class='account'>
            <nav>
                <ul>
                    <li><a href="./Vintage Visions/account.php">Account</a></li>
                    <li><a href="#">Cart</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div>

        <div class='welcome'>
            <h2 class='signuptoday'> Welcome to the Club!</h2>
            <h3 class='text2'> Tune into the vintage culture to be greeted </h3>
            <h3 class='text3'> with some welcoming gifts and member benefits! </h3>

            <h3 class='text4'> New here? Register now! </h3>
            <button class="button2" onclick="window.location.href = 'registration.php';"> Register </button>

            <?php
            if (isset($_SESSION['status'])) {
            ?>
                <div>
                    <h5 class='text2'> <?= $_SESSION['status']; ?> </h5>
                </div>
            <?php
                unset($_SESSION['status']);
            }
            ?>
        </div>

        <div id="vertical-line"></div>

        <div>
            <form class="login" action="logincode.php" method="post" autocomplete="off" onsubmit="return validateLoginForm()">
                <input class="inputl" type="text" name="email" id="email" placeholder="Email" required>
                <div id="emailError" style="color: red;"></div>

                <input class="inputl" type="password" name="password" id="pass" placeholder="Password" required>
                <div id="passwordError" style="color: red;"></div>

                <button class="buttonl" type="submit" name="login_now_btn">Login</button>
            </form>

        </div>
        <p class='forgot'> Forgotten your password? Don't worry, reset here now!<a href="reset-pass.php" class='reset'>Reset Now</a> </p>
    </div>
    </div>
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

        return isValid;
    }
</script>

</html>