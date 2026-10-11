<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

if (file_exists('db_conn.php')) {
    include 'db_conn.php';
} else {
    echo json_encode(["success" => false, "message" => "File db_conn.php not found."]);
    exit;
}

if (!$conn) {
    echo json_encode(["success" => false, "message" => "Failed connect database."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['customerName']) ? trim($_POST['customerName']) : '';
    $username = isset($_POST['customerUsername']) ? trim($_POST['customerUsername']) : '';
    $password = isset($_POST['customerPassword']) ? trim($_POST['customerPassword']) : '';
    $email = isset($_POST['customerEmail']) ? trim($_POST['customerEmail']) : '';
    $phone = isset($_POST['customerPhone']) ? trim($_POST['customerPhone']) : '';
    $address = isset($_POST['customerAddress']) ? trim($_POST['customerAddress']) : '';

    if (empty($name) || empty($username) || empty($password) || empty($email) || empty($phone) || empty($address)) {
        echo json_encode(["success" => false, "message" => "Please fill all the details."]);
        exit;
    }

    $checkSql = "SELECT custID FROM customer WHERE custUsername = ?";
    $stmtCheck = $conn->prepare($checkSql);
    $stmtCheck->bind_param("s", $username);
    $stmtCheck->execute();
    $stmtCheck->store_result();
    
    if ($stmtCheck->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Username is already in use."]);
        $stmtCheck->close();
        $conn->close();
        exit;
    }
    $stmtCheck->close();

    $sql = "INSERT INTO customer (custName, custPhoneNo, custEmail, custUsername, custPassword, custAddress) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssssss", $name, $phone, $email, $username, $password, $address);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Registration successful!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error SQL: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid method."]);
}

$conn->close();
?>