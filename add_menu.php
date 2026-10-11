<?php
header('Content-Type: application/json');

include 'db_conn.php';


if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Failed to connect database."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuName    = $_POST['menuName'];
    $menuPrice   = $_POST['menuPrice'];
    $menuDetails = $_POST['menuDetails'];
    $menuStatus  = $_POST['menuStatus'];
    
    if (isset($_FILES['menuImage']) && $_FILES['menuImage']['error'] === 0) {
        $fileName = $_FILES['menuImage']['name'];
        $fileTmp  = $_FILES['menuImage']['tmp_name'];
        $uploadFolder = "img/"; 
        
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }
        
        $targetPath = $uploadFolder . basename($fileName);
        
        if (move_uploaded_file($fileTmp, $targetPath)) {

            $stmt = $conn->prepare("INSERT INTO menu (menuName, menuPrice, menuDetails, menuStatus, menuimage) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sdsss", $menuName, $menuPrice, $menuDetails, $menuStatus, $fileName);
            
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Menu updated"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to store at database: " . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Failed to upload image."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Please choose image."]);
    }
}

$conn->close();
?>