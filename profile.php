<?php
session_start();

//Timezone
date_default_timezone_set('Asia/Kuala_Lumpur');

//Security Check
if(!isset($_SESSION['cust_logged_in']) || $_SESSION['cust_logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

if (file_exists('db_conn.php')) {
    include 'db_conn.php';
} else {
    $conn = new mysqli("localhost", "root", "", "mijies_cafe");
}

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$custID = $_SESSION['custID']; 

//Profile Data
$sql = "SELECT * FROM customer WHERE custID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $custID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

//Order History Data
$sql_history = "SELECT * FROM orders WHERE custID = ? ORDER BY orderID DESC";
$stmt_history = $conn->prepare($sql_history);
$stmt_history->bind_param("i", $custID);
$stmt_history->execute();
$history_result = $stmt_history->get_result();
$stmt_history->close();

$conn->close();

include 'profile_view.php';
?>