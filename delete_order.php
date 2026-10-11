<?php
header('Content-Type: application/json');

include 'db_conn.php';

$orderID = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($orderID > 0) {

    $sql = "DELETE FROM orders WHERE orderID = $orderID";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Order deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid Order ID tracking reference received']);
}

$conn->close();
?>