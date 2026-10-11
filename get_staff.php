<?php

header('Content-Type: application/json');

include 'db_conn.php';

$sql = "SELECT staffID, staffName, staffPhoneNo, staffPosition FROM staff ORDER BY staffID ASC";
$result = $conn->query($sql);

$staff_list = array();

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $staff_list[] = $row;
    }
}

echo json_encode($staff_list);

// Close connection
$conn->close();
?>