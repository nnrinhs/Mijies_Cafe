<?php

header('Content-Type: application/json');

include 'db_conn.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $menuID = $_POST['menuID'];
    $menuName = $_POST['menuName'];
    $menuDetails = $_POST['menuDetails']; 
    $menuPrice = $_POST['menuPrice'];
    $menuStatus = $_POST['menuStatus'];

    $sql = "UPDATE menu SET menuName=?, menuDetails=?, menuPrice=?, menuStatus=? WHERE menuID=?";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssdsi", $menuName, $menuDetails, $menuPrice, $menuStatus, $menuID);

        if ($stmt->execute()) {

            echo json_encode(["success" => true, "message" => "Menu item updated successfully!"]);
        } else {

            echo json_encode(["success" => false, "message" => "Failed to execute database update."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "SQL preparation failed: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>