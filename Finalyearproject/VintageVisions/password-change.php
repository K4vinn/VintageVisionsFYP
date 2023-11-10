<?php 
session_start();
$page_title = "password change update";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="./Style/Home.css">
        <link rel="stylesheet" href="./Style/reset.css">
        <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <div class='navbar'> <nav>
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

            <div class='account'> <nav>
                    <ul>
                        <li><a href="./Vintage Visions/account.php">Account</a></li>
                        <li><a href="#">Cart</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div>

        <?php
                if(isset($_SESSION['status']))
                {
                    ?>
                    <div class="alert alert-success">
                        <h5> <?= $_SESSION['status'];?> </h5>
                    </div>
                    <?php
                    unset($_SESSION['status']);
                    }
            ?>

                <form class="login" action="password-reset-code.php" method="post" autocomplete="off">
                <input type='hidden' name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
                    
                 <input class="inputr" type="text" name="email" id="email" placeholder="Email" required value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>"> <br/>
             
                 <input class="inputr" type="password" name="new_password" id="password" placeholder="Password" required value=""> <br/>
                 
                 <input class="inputr" type="password" name="confirm_password" id="confirmpassword" placeholder="Confirm Password" required value=""> <br/>

                 <button class="buttonr" type="submit" name="password_update"> Update Now! </button>
                </form>
            </div>
        </div>
</body>

</html>