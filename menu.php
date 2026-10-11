<?php
header('Content-Type: application/json');
include 'db_conn.php';
//$conn = new mysqli("localhost", "root", "", "mijies_cafe");

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}


$kategori = $_GET['cat'] ?? 'Breakfast';

if ($kategori == 'Package') {

    $sql = "SELECT packageName as name, packagePrice as price, packageimage as img, packageDetail as detail, status FROM package";
} else {

    $sql = "SELECT menuName as name, menuPrice as price, menuImage as img, '' as detail, menuStatus as status FROM menu WHERE menuDetails = '$kategori'";
}

$result = $conn->query($sql);
$data = [];
if ($result) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);
$conn->close();
?>