<?php
include("../Includes/admin-main.php");
include("../Includes/admin-navbar.php");
include("../Config/Database.php");

$get_support = "SELECT * FROM support";
$get_support_results = mysqli_query($con, $get_support);
?>

<link rel="stylesheet" href="../Style/admin-support.css">

<h1 class='sp-header'> Support Control </h1>
<p class='sp-desc'> Manage support messages - Closing when complete </p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($get_support_results)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['support_email'] . "</td>";
            echo "<td>" . $row['support_subject'] . "</td>";
            echo "<td>" . $row['support_message'] . "</td>";
            echo "<td>" . ($row['status'] == 1 ? 'Complete' : 'Incomplete') . "</td>";
            echo "<td>";
            if ($row['status'] == 0) {
                echo "<button class='edit-button' onclick=\"closeCase(" . $row['id'] . ")\">
                    <div>
                        Close Case
                    </div>
                </button>";
            }
            echo "</tr>";
        }
        ?>

    </tbody>
</table>

<script>
    function closeCase(id) {
        if (confirm("Are you sure you want to close this case?")) {
            // Send an AJAX request or redirect to a PHP script to update the status
            window.location.href = "edit-support.php?id=" + id;
        }
    }
</script>