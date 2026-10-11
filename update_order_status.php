<?php
header('Content-Type: application/json');

include 'db_conn.php';

$orderID = isset($_POST['id']) ? intval($_POST['id']) : 0;
$statusValue = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : '';

if ($orderID > 0 && !empty($statusValue)) {

    $sql = "UPDATE orders SET orderStatus = '$statusValue' WHERE orderID = $orderID";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Order status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error execution: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters received by backend script']);
}

$conn->close();
?>