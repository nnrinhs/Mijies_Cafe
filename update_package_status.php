<?php
header('Content-Type: application/json');
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $packageID = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if ($packageID > 0 && !empty($status)) {
        $sql = "UPDATE package SET status = ? WHERE packageID = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("si", $status, $packageID);
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Status updated successfully."]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to update database."]);
            }
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "SQL Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid parameters."]);
    }
}
$conn->close();
?>