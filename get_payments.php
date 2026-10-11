<?php
header('Content-Type: application/json');

include 'db_conn.php';

$sql = "SELECT p.paymentID, p.paymentProof, p.paymentDate, p.paymentAmount, p.orderID, o.orderStatus, o.orderDetail 
        FROM payment p 
        LEFT JOIN orders o ON p.orderID = o.orderID 
        ORDER BY p.paymentID DESC";

$result = $conn->query($sql);

$payments = array();
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $payments[] = $row;
    }
}

echo json_encode($payments);
$conn->close();
?>