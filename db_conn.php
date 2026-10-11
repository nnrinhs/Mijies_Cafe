<?php
$servername = "sql104.infinityfree.com";
$username = "if0_42353353";
$password = "Nurin2006";
$dbname = "if0_42353353_mijiescafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
}
?>