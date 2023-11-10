<?php
include("../includes/header.php");
include("../Config/Database.php");
session_start();

if (isset($_SESSION["authorized"])) {
    $email = $_SESSION['email'];
}

?>


<div class="supportheader">
    Support </div>
<div class="supporttext-box">
    <div class="supporttext"> Need additional help? Drop us a message </div>
    <form class="support-form" action="../Vintage Visions/support_send.php" method="post" autocomplete="off">
        <input class="support-input" type="text" name="email" id="email" placeholder="Email" <?php if (!empty($email)) {
                                                                                                    echo "value='$email' readonly";
                                                                                                } else {
                                                                                                    echo "required";
                                                                                                } ?>>

        <input class="support-input" type="text" name="subject" id="subject" placeholder="Subject" required>

        <textarea class="support-input-message" maxlength="500" type="text" name="message" id="message" placeholder="Please enter your message..." required></textarea>
        <br />
        <button class="support-send" type="submit" name="support_send">Submit</button>
    </form>


    <?php
    if (isset($_SESSION['status'])) {
    ?>
        <div class="alert-box-spt">
            <h5 class='spt-confirmation'> <?= $_SESSION['status']; ?> </h5>
        </div>
    <?php
        unset($_SESSION['status']);
    }
    ?>

</div>


<script>

</script>

<!-- <div class="faq-1-box">
</div>
<div class="faq-2-box">
</div> -->
<!-- <div class="faq-2">
    <span>
        <span class="faq-2-span">Why are there products on the website that I cannot buy online?<br />
        </span>
        <span class="faq-2-span2">The majority of our IKEA product range is available at our online shop. However, only products with available stock will appear with the &quot;BUY&quot; button.</span>
    </span>
</div>

<div class="frequently-asked-questions">
    Frequently Asked Questions </div>
<div class="faq-1">
    <span>
        <span class="faq-1-span"> How do I place an order?These are general steps of your shopping journey with us:<br />
        </span>
        <span class="faq-1-span2"> Choose your product, add to cart &amp; amend quantity<br /> Check order details<br />Confirm your shopping cart<br />Provide shipping &amp; billing information<br />Choose payment options and finalize payment<br />You will see the payment transaction status on your screen<br />For successful transaction, we will email you the order confirmation shortly</span>
    </span>
</div>
<div class="faqunderline-1">
</div> -->
<!-- 
<?php include("../includes/footer.php") ?> -->