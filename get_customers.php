<?php
header('Content-Type: application/json');
include 'db_conn.php';

$sql = "SELECT c.custID, c.custName, c.custPhoneNo, c.custEmail, c.custUsername, c.custPassword, c.custAddress, COUNT(o.orderID) AS total_orders 
        FROM customer c 
        LEFT JOIN orders o ON c.custID = o.custID 
        GROUP BY c.custID 
        ORDER BY c.custID DESC";

$result = $conn->query($sql);
$customers = array();

if ($result) {
    while($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
    echo json_encode($customers);
} else {
    echo json_encode(["success" => false, "message" => "SQL Error: " . $conn->error]);
}
$conn->close();
?>