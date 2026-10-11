<?php
header('Content-Type: application/json');

include 'db_conn.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$staffID = $data['id'] ?? null;

if (!$staffID) {
    echo json_encode(["success" => false, "message" => "Invalid or missing Staff ID."]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM staff WHERE staffID = ?");
$stmt->bind_param("i", $staffID);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Staff privileges revoked and record deleted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete staff record from the database."]);
}

$stmt->close();
$conn->close();
?>