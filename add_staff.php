<?php
header('Content-Type: application/json');

include 'db_conn.php';   


if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Failed to connect database."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staffName     = $_POST['staffName'];
    $staffPhoneNo  = $_POST['staffPhoneNo'];
    $staffPosition = $_POST['staffPosition'];
    $staffEmail    = $_POST['staffEmail'];
    $staffUsername = $_POST['staffUsername'];
    $staffPassword = $_POST['staffPassword']; 
    $staffAddress  = $_POST['staffAddress'];
    $staffProfilePic = NULL; 


    $stmt = $conn->prepare("INSERT INTO staff (staffName, staffPhoneNo, staffPosition, staffProfilePic, staffEmail, staffUsername, staffPassword, staffAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    

    $stmt->bind_param("ssssssss", $staffName, $staffPhoneNo, $staffPosition, $staffProfilePic, $staffEmail, $staffUsername, $staffPassword, $staffAddress);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "New Staff updated!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed store database: " . $stmt->error]);
    }
    $stmt->close();
}

$conn->close();
?>