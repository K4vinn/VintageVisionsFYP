<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

$queryProduct = "SELECT * FROM products";
$queryProductRun = mysqli_query($con, $queryProduct);

$queryPayment = "SELECT * FROM payments WHERE status = 'complete'";
$queryPaymentRun = mysqli_query($con, $queryPayment);

$totalnum = 0;

if ($queryPaymentRun) {
    $totalPayments = mysqli_num_rows($queryPaymentRun);

    while ($row = mysqli_fetch_assoc($queryPaymentRun)) {
        $productId = json_decode($row['product_id'], true);
        $num = count($productId);
        $totalnum += $num;
    }
}


?>

<link rel="stylesheet" href="../Style/admin-order.css">

<h1 class='order-header'> Analytics </h1>
<p class='order-desc'> View Statistics and Analytics of Products. </p>

<body>
    <div id='pie-chart'></div>
    <h1 class='header-2'> Sales analytics </h1>
</body>

<script>
    var data = [{
        type: "pie",
        values: [<?php echo $totalnum ?>, <?php echo $totalPayments ?>],
        labels: ["Total Products Sold", "Sales"],
        textinfo: "label+percent",
        textposition: "outside",
        automargin: true
    }]

    var layout = {
        height: 400,
        width: 400,
        margin: {
            "t": 0,
            "b": 0,
        },
        showlegend: false
    }

    Plotly.newPlot('pie-chart', data, layout)
</script>