<?php
header('Content-Type: application/json');

include 'db_conn.php';

$sql = "SELECT orderID, orderDetail, orderDate, orderStatus FROM orders ORDER BY orderID DESC";
$result = $conn->query($sql);

$orders = array();
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

echo json_encode($orders);
$conn->close();
?>