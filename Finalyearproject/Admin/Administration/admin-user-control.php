<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

$get_users = "SELECT * FROM users";
$get_users_results = mysqli_query($con, $get_users);
?>
<link rel="stylesheet" href="../Style/admin-user.css">
<h1 class='user-header'> Product Control </h1>
<p class='user-desc'> Manage products from adding, deleting and editing, and stock control </p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Shipping Details</th>
            <th>Phone Number</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($get_users_results)) {
            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['user_shipping'] . "</td>";
            echo "<td>" . $row['user_phonenum'] . "</td>";
            echo "<td>
        <button class='edit-button' onclick=\"window.location.href='edit-user.php?id=" . $row['user_id'] . "'\">
            <div>
                Edit Product
            </div>
        </button>
        <button class='delete-button' data-product-id='" . $row['user_id'] . "'>
            <div>
                Delete Product
            </div>
        </button>
    </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function() {
            var productId = $(this).data('product-id');

            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    type: 'POST',
                    url: 'delete-user.php',
                    data: {
                        user_id: productId
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        });
    });
</script>