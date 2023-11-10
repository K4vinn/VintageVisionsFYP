<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="./Style/Home.css">
        <link rel="stylesheet" href="./Style/Reset.css">
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
                <h1 class='resetpassnow'> Reset your password </h1>
                <h3 class='text2'> Oh no! Seems like you've forgotten your password!</h3>
                <h3 class='text2'> Not to worry, reset it now!</h3>
        </div>
        <div id="vertical-line"></div>
        <div class="resetp">
                <form class="resetp" action="password-reset-code.php" method="post" autocomplete="off">
                    
                 <input class="inputreset" type="text" name="email" id="email" placeholder="Email" required value=""> <br/>
             
                 <button class="buttonreset" type="submit" name="password_reset_link"> Reset </button>
                </form>
            </div>
        </div>

        <div class='resetb'>
            <hr class='resetline'/>
            <br/>
            <h3 class='text3'> Don't want to change? Return now.</h3>
            <button class="resetback" onclick="window.location.href = 'login.php';"> Return Now! </button>
        </div>
</body>

</html>