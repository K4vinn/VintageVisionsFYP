<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");
$get_p = "SELECT * FROM payments";
$get_payments_results = mysqli_query($con, $get_p)
?>

<link rel="stylesheet" href="../Style/admin-order.css">

<h1 class='order-header'> Order Control </h1>
<p class='order-desc'> View Orders that are completed. </p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Payment ID</th>
            <th>Status</th>
            <th>Product ID</th>
            <th>User ID</th>

        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($get_payments_results)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['payment_id'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['product_id'] . "</td>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>