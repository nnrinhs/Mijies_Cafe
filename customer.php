<?php
header('Content-Type: application/json');

include 'db_conn.php';

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$sql = "SELECT custID, custName, custPhoneNo, custEmail, custUsername, custPassword, custAddress FROM customer";
$result = $conn->query($sql);

$customerData = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $customerData[] = $row;
    }
}

echo json_encode($customerData);
$conn->close();
?>