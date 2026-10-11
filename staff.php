<?php
header('Content-Type: application/json');

include 'db_conn.php';

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$sql = "SELECT staffID, staffName, staffPhoneNo, staffPosition, staffEmail, staffUsername, staffPassword, staffAddress FROM staff";
$result = $conn->query($sql);

$staffData = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $staffData[] = $row;
    }
}

echo json_encode($staffData);
$conn->close();
?>