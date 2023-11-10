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

        <!-- Change PW -->
        <button id="change-pw" class="change-button">
            <div class="change-pw">Change Password </div>
        </button>

        <script>
            document.getElementById("change-pw").addEventListener("click", function() {
                window.location.href = "../Vintage Visions/accountchangepw.php";
            });
        </script>
    </div>

    <div class="purchase-box">
        <div class="history-text">Purchase History</div>
        <div class="history-card"></div>
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
                </a>';
                }
            } else {
                echo "No items found in the wishlist.";
            }
        } else {
            echo "Error executing the query.";
        }
        ?>

        <div class="wishlist-viewmore">
            <button class="wishlist-viewmore"> View More </button>
        </div>
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