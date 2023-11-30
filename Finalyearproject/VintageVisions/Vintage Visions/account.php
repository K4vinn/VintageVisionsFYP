<?php
include("../includes/header.php");
include('../authentication.php');
include('../Config/Database.php');

$email = $_SESSION['auth_user']['email'];
$getUserInfo = "SELECT * FROM users WHERE email = '$email'";
$getUserInfoResults = mysqli_query($con, $getUserInfo);

?>

<div class="profile">
    <div class="accheader"> Account </div>
    <div class="acc-box">
        <div class="personal-header"> Personal Information </div>

        <?php
        if ($getUserInfoResults && mysqli_num_rows($getUserInfoResults) > 0) {
            $row = mysqli_fetch_assoc($getUserInfoResults);
            echo '<ul class="acc-info-box">
            <li> Email: ' . $row['email'] . '</li>
            <li> Shipping Address: ' . $row['user_shipping'] . '</li>
            <li> Phone Number: ' . $row['user_phonenum'] . '</li>
        </ul>';
        }
        ?>
        <button id="edit-button" class="edit-button">
            <h3 class="edit-info"> Edit Information </h3>
        </button>

        <script>
            document.getElementById("edit-button").addEventListener("click", function() {
                window.location.href = "../Vintage Visions/accountedit.php";
            });
        </script>

        <script>
            document.getElementById("change-pw").addEventListener("click", function() {
                window.location.href = "../Vintage Visions/accountchangepw.php";
            });
        </script>
    </div>

    <div class="purchase-box">
        <div class="history-text">Purchase History</div>
        <?php
        $products_id = "SELECT * FROM payments WHERE email = '$email'";
        $products_id_run = mysqli_query($con, $products_id);

        if ($products_id_run) {
            $cardsDisplayed = 0; // Counter for displayed cards
            while (($row = mysqli_fetch_assoc($products_id_run)) && ($cardsDisplayed < 3)) {

                $idArray = $row['product_id'];
                $prodId = json_decode($idArray);

                if ($prodId !== null) {
                    foreach ($prodId as $productdisplay) {
                        $productget = "SELECT * FROM products WHERE id = '$productdisplay'";
                        $productrun = mysqli_query($con, $productget);

                        if ($productrun) {
                            $productData = mysqli_fetch_assoc($productrun);
                            echo '<div class="wishlist-card">
                            <div class="wishlist-image">
                                <img class="wishlist-img-inner" src="' . $productData['product_image'] . '">
                            </div>
                            <div class="wishlist-item-name">
                                <h1>' . $productData['product_name'] . '</h1>
                                <h1> RM ' . $productData['product_price'] . '</h1>
                            </div>
                        </div>';
                            $cardsDisplayed++;

                            if ($cardsDisplayed >= 3) {
                                break; // Exit the loop after displaying 3 cards
                            }
                        }
                    }
                }
            }
        } else {
            echo "Error fetching data from the database: " . mysqli_error($con);
        }
        ?>
    </div>



    <div class="wishlist-box">
        <div class="favourites"> Wishlist </div>

        <?php
        $user_id = $_SESSION['user_id'];
        $wishlistsql = "SELECT p.id, p.product_name, p.product_price, p.product_image
        FROM wishlist AS w
        INNER JOIN products AS p ON p.id = w.product_id
        WHERE w.user_id = $user_id
        ORDER BY RAND()
        LIMIT 3;"; // Limit to 3 items

        $wishlistsqlres = mysqli_query($con, $wishlistsql);

        if ($wishlistsqlres) {
            if (mysqli_num_rows($wishlistsqlres) > 0) {
                while ($row = mysqli_fetch_assoc($wishlistsqlres)) {
                    echo '<a href="http://localhost/Finalyearproject/Vintage%20Visions/products.php?product/link&id=' . $row['id'] . '">
                    <div class="wishlist-card">
                        <div class="wishlist-image">
                            <img class="wishlist-img-inner" src="' . $row['product_image'] . '">
                        </div>
                        <div class="wishlist-item-name">
                            <h1>' . $row['product_name'] . '</h1>
                            <h1> RM ' . $row['product_price'] . '</h1>
                        </div>
                    </div>
                </a>
        ';
                }
            } else {
                echo "<h2 class='wishlist-text'> No items found in the wishlist. </h2>";
            }
        } else {
            echo "Error executing the query.";
        }
        ?>
        <button id="wishlist-viewmore" class="wishlist-viewmore"> View More </button>

        <script>
            document.getElementById("wishlist-viewmore").addEventListener("click", function() {
                window.location.href = "../Vintage Visions/wishlist-cart.php";
            });
        </script>
    </div>

    <form method="post" action="delete_account.php">
        <input class="delete-acc" type="submit" name="delete_account" value="Delete My Account" onclick="openModal(); return false;">
    </form>

    <!-- Modal -->
    <div id="confirmationModal">
        <div>
            <p>Are you sure you want to delete your account? This action is irreversible.</p>
            <form method="post" action="delete_account.php">
                <input type="submit" name="confirm_delete" value="Confirm Delete" class="confirm">
                <button onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }
    </script>

</div>