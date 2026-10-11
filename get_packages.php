<?php
header('Content-Type: application/json');

include 'db_conn.php';

$sql = "SELECT packageID, packageName, packageDetail, packagePrice, status FROM package ORDER BY packageID ASC";
$result = $conn->query($sql);

$packages = array();

if ($result && $result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}

echo json_encode($packages);

$conn->close();
?>