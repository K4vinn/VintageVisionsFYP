<?php
session_start();
include "./Config/Database.php";
?>


<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="./Style/Home.css">
    <link rel="stylesheet" href="./Style/Registration.css">
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
        <h2 class='signuptoday'> Join Us Today </h2>
        <h3 class='text2'> Tune into the vintage culture to be greeted </h3>
        <h3 class='text3'> with some welcoming gifts and member benefits! </h3>
        <h3 class='text3'> We're excited to have you as a member of this family!</h3>
    </div>
    <div id="vertical-line"></div>
    <div>

        <div>
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
            <form class="login" action="registercode.php" method="post" autocomplete="off" onsubmit="return validateForm()">
                <input class="inputr" type="text" name="name" id="name" placeholder="Name" required>
                <div id="nameError" style="color: red;"></div>

                <input class="inputr" type="text" name="email" id="email" placeholder="Email" required>
                <div id="emailError" style="color: red;"></div>

                <input class="inputr" type="password" name="password" id="password" placeholder="Password" required>
                <div id="passwordError" style="color: red;"></div>

                <input class="inputr" type="password" name="confirm-password" id="confirmPassword" placeholder="Confirm Password" required>
                <div id="confirmPasswordError" style="color: red;"></div>

                <button class="buttonr" type="submit" name="register-btn">Register</button>
            </form>
        </div>
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