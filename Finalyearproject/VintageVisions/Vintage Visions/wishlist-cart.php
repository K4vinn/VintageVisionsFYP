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
            <a class="wishlist-link" href="http://localhost:8000/VintageVisions/Vintage%20Visions/products.php?product/link&id=' . $row['id'] . '">
            <div class="wishlist-container">
            <div class="trash-can" data-product-id="' . $row['id'] . '" onclick="deleteItem(this)"> X </div>
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
    document.getElementById("to-account").addEventListener("click", function() {
        window.location.href = "account.php";
    });
    // Trash
    function deleteItem(cartContainer) {
        console.log('Item deleted');
        // Add your delete logic here

        var productId = cartContainer.getAttribute("data-product-id");

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_wishlist_item.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Response from the PHP file after item deletion
                console.log(xhr.responseText);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        };

        // Construct the data payload for the request
        var data = "product_id=" + productId;
        xhr.send(data);
    }
</script>