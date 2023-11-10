<?php
include("../Config/Database.php");
include("../includes/header.php");

session_start();
$user_id = $_SESSION['auth_user']['user_id'];

echo "<div class='failed-box'>";
        echo "<h1 class='failed-message'> Payment has failed. <br/> There was no charges to your card. <br/> Please try again later. </h1>";
        echo "<button class='return-home' onclick='returnHome()'>";
        echo "Return to Home!";

        echo "</button>";
        echo "</div>";

?>

<link rel="stylesheet" href="../Style/success.css">
<script>
    // JavaScript function to redirect to home.php
    function returnHome() {
        // Redirect to home.php
        window.location.href = 'home.php';
    }
</script>