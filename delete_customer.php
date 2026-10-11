<?php
header('Content-Type: application/json');

include 'db_conn.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$custID = $data['id'] ?? null;

if (!$custID) {
    echo json_encode(["success" => false, "message" => "Invalid or missing Customer ID."]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM customer WHERE custID = ?");
$stmt->bind_param("i", $custID);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Customer deleted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete customer record."]);
}

$stmt->close();
$conn->close();
?>