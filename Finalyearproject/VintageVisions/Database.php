<?php
$sname = 'localhost';
$username = 'root';
$password = '';

$db_name = "vintagevision";

$con = mysqli_connect($sname, $username, $password, $db_name);

if (!$con) {
    echo "Database Is Not Active";
    exit();
}
?>