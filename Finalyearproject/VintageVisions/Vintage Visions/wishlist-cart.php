<?php
include("../includes/header.php");
include("../Config/Database.php");
include("../authentication.php");

if (isset($_SESSION["email"])) {
    $user_id = $_SESSION["auth_user"]["user_id"]; //email has been found.
}

$get_wishlist = "SELECT p.id, p.product_name, p.product_price, p.product_image
FROM wishlist AS w
INNER JOIN products AS p ON p.id = w.product_id
WHERE w.user_id = $user_id";
$wishlist_res = mysqli_query($con, $get_wishlist);
?>

<div class="info-header"> Wishlist </div>

<div class="cart-box">
    <?php
    if ($wishlist_res->num_rows > 0) {
        while ($row = $wishlist_res->fetch_assoc()) {
            echo '
            <a class="wishlist-link" href="products.php?product/link&id=' . $row['id'] . '">
            <div class="wishlist-container">
            <div class="cart-image">
                <img class="wishlist-img" src="' . $row['product_image'] . '">
            </div>
            <div class="cart-item-variation">
                <h2>' . $row['product_name'] . '</h2>
            </div>
            <div class="cart-item-amount">
                <h2> RM ' . $row['product_price'] . '</h2>
            </div>    
        </div>';
        }
    } else {
        echo '<h2>Your wishlist is empty.</h2>';
    }
    ?>
    <button class="wishlist-now" id="to-account">
        <div id="acc-btn" class="wishlist-button">To Account</div>
    </button>
    <br /><br /><br /><br />

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.addEventListener("click", function(event) {
            var backButton = event.target.closest(".to-account");
            if (backButton) {
                var accUrl = "account.php";
                window.location.href = accUrl;
            }
        });
    });
</script>