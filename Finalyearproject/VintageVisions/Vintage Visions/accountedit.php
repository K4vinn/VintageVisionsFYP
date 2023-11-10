<?php
include("../includes/header.php");
include('../authentication.php');
include('../Config/Database.php');

$email = $_SESSION['auth_user']['email'];
$getData = "SELECT * FROM users WHERE email = '$email'";
$getDataRes = mysqli_query($con, $getData);
?>


<div class="edit-information-header">
    Edit Information </div>
<div class="edit-info-box">


    <form class="edit-form" action="editaccount.php" method="post">
        <?php
        if ($getDataRes && mysqli_num_rows($getDataRes) > 0) {
            $row = mysqli_fetch_assoc($getDataRes);
            echo '<div class="fn-input">
            <label for="full-name" class="fn-header">Full Name</label>
            <input type="text" id="full-name" name="full-name" value="' . $row['name'] . '">
        </div>

        <div class="sa-input">
            <label for="shipping-address" class="sa-header">Shipping Address</label>
            <input type="text" id="shipping-address" value="' . $row['user_shipping'] . '" name="shipping-address">
        </div>

        <div class="pn-input">
            <label for="phone-number" class="pn-header">Phone Number</label>
            <input type="tel" id="phone-number" value="+60' . $row['user_phonenum'] . '" name="phone-number">
        </div>

        <div class="email-input">
            <label for="email" class="email-header">Email</label>
            <input type="email" id="email" value="' . $row['email'] . '" name="email" readonly>
        </div>

        <input type="submit" name="submitacc" value="Submit">';
        }
        ?>
    </form>

</div>