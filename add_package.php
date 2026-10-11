<?php
header('Content-Type: application/json');

include 'db_conn.php';  


if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Failed to connect database."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $packageName  = $_POST['packageName'];
    $packageDetail = $_POST['packageDetail'];
    $packagePrice = $_POST['packagePrice'];
    $status        = $_POST['status'];
    
    if (isset($_FILES['packageimage']) && $_FILES['packageimage']['error'] === 0) {
        $fileName = $_FILES['packageimage']['name'];
        $fileTmp  = $_FILES['packageimage']['tmp_name'];
        
        $uploadFolder = "images/"; 
        
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }
        
        $targetPath = $uploadFolder . basename($fileName);
        
        if (move_uploaded_file($fileTmp, $targetPath)) {
            $stmt = $conn->prepare("INSERT INTO package (packageName, packageDetail, packagePrice, status, packageimage) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdss", $packageName, $packageDetail, $packagePrice, $status, $fileName);
            
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "New Package Success to stored!"]);
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