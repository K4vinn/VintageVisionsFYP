<?php
include("../includes/header.php");
include("../Config/Database.php");

$user_id = $_SESSION['auth_user']['user_id'];

$isAuthorized = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;

// Use prepared statements to prevent SQL injection
$get_cart_query = "SELECT p.id, p.product_name, p.product_price, p.product_image, c.cart_total
                  FROM cart AS c
                  INNER JOIN products AS p ON p.id = c.product_id
                  WHERE c.user_id = ?";
$get_cart_statement = mysqli_prepare($con, $get_cart_query);
mysqli_stmt_bind_param($get_cart_statement, "i", $user_id);
mysqli_stmt_execute($get_cart_statement);
$cart_res = mysqli_stmt_get_result($get_cart_statement);
?>

<div class="info-header">Your Cart</div>

<div class="cart-box">
    <?php if ($cart_res->num_rows > 0) { ?>
        <?php while ($row = $cart_res->fetch_assoc()) {
            // Retrieve the cart_total value from the query
            $cartTotal = $row['cart_total'];
        ?>
            <div class="cart-container" data-product-id="<?php echo $row['id']; ?>">
                <div class="trash-can" data-product-id="<?php echo $row['id']; ?>" onclick="deleteItem(this)"> X </div>
                <div class="cart-image">
                    <img class="wishlist-img" src="<?php echo $row['product_image']; ?>">
                </div>
                <div class="cart-item-variation">
                    <h2><?php echo $row['product_name']; ?></h2>
                </div>
                <div class="cart-item-amount">
                    <h2>RM <?php echo $row['product_price']; ?></h2>
                </div>
                <div class="total-amount">
                    <div class="cart-minus">-</div>
                    <div class="cart-total">
                        <h3><?php echo $cartTotal; ?></h3> <!-- Use the retrieved quantity -->
                    </div>
                    <div class="cart-plus">+</div>
                </div>
            </div>
        <?php } ?>
    <?php } else {
        echo '<h2 class="empty-cart">Your Cart is empty.</h2>';
    } ?>
    <br /><br /><br /><br />
    <button id="checkout-now" class="checkout-now" <?php if ($cart_res->num_rows == 0) echo 'disabled'; ?>>
        <div class="checkout-button">Checkout</div>
    </button>
</div>
<script>
    //Next
    document.addEventListener("DOMContentLoaded", function() {

        var cartContainers = document.querySelectorAll(".cart-container");

        cartContainers.forEach(function(cartContainer) {
            var minusButton = cartContainer.querySelector(".cart-minus");
            var plusButton = cartContainer.querySelector(".cart-plus");
            var totalQuantity = cartContainer.querySelector(".cart-total h3");

            minusButton.addEventListener("click", function() {
                var currentQuantity = parseInt(totalQuantity.textContent);
                if (currentQuantity > 0) {
                    var newQuantity = currentQuantity - 1;
                    totalQuantity.textContent = newQuantity;

                    // Update the quantity in the database via AJAX
                    updateDatabase(cartContainer, newQuantity);
                }
            });

            plusButton.addEventListener("click", function() {
                var currentQuantity = parseInt(totalQuantity.textContent);
                var newQuantity = currentQuantity + 1;
                totalQuantity.textContent = newQuantity;

                // Update the quantity in the database via AJAX
                updateDatabase(cartContainer, newQuantity);
            });
        });
    });


    function updateDatabase(cartContainer, newQuantity) {
        var productId = cartContainer.getAttribute("data-product-id");
        // Send an AJAX request to update the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_quantity.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response from the server, if needed
            }
        };

        var data = "product_id=" + productId + "&cart_total=" + newQuantity;
        xhr.send(data);
    }

    // Trash
    function deleteItem(cartContainer) {
        console.log('Item deleted');
        // Add your delete logic here

        var productId = cartContainer.getAttribute("data-product-id");

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_cart_item.php', true);
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


    // Your code for the "Checkout" button
    var toCheckout = document.querySelector(".checkout-now");
    toCheckout.addEventListener("click", function() {
        // Check if the cart is empty based on the total quantity of all items
        var totalQuantities = document.querySelectorAll(".cart-total h3");
        var isCartEmpty = true;
        var productIds = [];

        totalQuantities.forEach(function(quantity, index) {
            var quantityValue = parseInt(quantity.textContent);
            if (quantityValue > 0) {
                isCartEmpty = false;

                // Retrieve the corresponding product ID based on the index
                var cartContainer = document.querySelectorAll(".cart-container")[index];
                var productId = cartContainer.getAttribute("data-product-id");
                productIds.push(productId);
            }
        });

        if (isCartEmpty) {
            alert("Your cart is empty. Add items to your cart before checking out.");
            return;
        }

        // Proceed to checkout
        var checkoutURL = "checkout.php";
        window.location.href = checkoutURL;
    });
</script>
</div>