<?php
session_start();
header('Content-Type: application/json');

if(isset($_SESSION['cust_logged_in']) && $_SESSION['cust_logged_in'] === true) {
    echo json_encode([
        'logged_in' => true,
        'custName' => $_SESSION['custName'] ?? '',
        'custPhoneNo' => $_SESSION['custPhoneNo'] ?? ''
    ]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>