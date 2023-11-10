<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");
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
        values: [2, 3, 4, 4],
        labels: ["Products", "Sales", "Total Bought", ""],
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
            "l": 0,
            "r": 0
        },
        showlegend: false
    }

    Plotly.newPlot('pie-chart', data, layout)
</script>