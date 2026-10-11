<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json');


if (isset($_SESSION['staff_logged_in']) && $_SESSION['staff_logged_in'] === true) {
    echo json_encode([
        "logged_in" => true,
        "role" => "staff",
        "user_id" => $_SESSION['user_id'],
        "user_name" => $_SESSION['user_name']
    ]);
    exit();
} 


else if (isset($_SESSION['cust_logged_in']) && $_SESSION['cust_logged_in'] === true) {
    echo json_encode([
        "logged_in" => true,
        "role" => "customer",
        "user_id" => $_SESSION['user_id'],
        "user_name" => $_SESSION['user_name']
    ]);
    exit();
} 

else {
    echo json_encode([
        "logged_in" => false,
        "role" => "guest"
    ]);
    exit();
}
?>