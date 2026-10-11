<?php
header('Content-Type: application/json');
include 'db_conn.php';

$sql = "SELECT menuID, menuName, menuDetails, menuPrice, menuStatus FROM menu ORDER BY menuID ASC";
$result = $conn->query($sql);

$menu_items = array();

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
} else {
    $menu_items = array();
}

echo json_encode($menu_items);
$conn->close();
?>