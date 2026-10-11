<?php
session_start(); 

header('Content-Type: application/json');

include 'db_conn.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $custID = isset($_SESSION['custID']) ? $_SESSION['custID'] : null;

    $orderDetail   = $_POST['orderDetail'] ?? '';
    $grandTotal    = $_POST['grandTotal'] ?? '0.00';
    $paymentMethod = $_POST['paymentMethod'] ?? 'cash';
    
    $paymentProof = "Paid via Cash"; 
    if ($paymentMethod === 'qr' && isset($_FILES['receiptFile'])) {
        $fileName = time() . "_" . $_FILES['receiptFile']['name'];
        if(move_uploaded_file($_FILES['receiptFile']['tmp_name'], "uploads/" . $fileName)) {
            $paymentProof = $fileName;
        }
    }

    $orderType = (strpos($orderDetail, "Type: Take Away") !== false) ? "Take Away" : "Dine-In";

    $sqlOrder = "INSERT INTO orders (custID, orderDetail, orderStatus, orderType, totalPrice, orderDate) \r
                 VALUES (" . ($custID ? "'".$conn->real_escape_string($custID)."'" : "NULL") . ", \r
                         '" . $conn->real_escape_string($orderDetail) . "', \r
                         'Preparing', \r
                         '$orderType', \r
                         '" . $conn->real_escape_string($grandTotal) . "', \r
                         NOW())";

    if ($conn->query($sqlOrder)) {
        $orderID = $conn->insert_id;
        
        $sqlPayment = "INSERT INTO payment (orderID, paymentProof, paymentDate, paymentAmount) \r
                       VALUES ('$orderID', '" . $conn->real_escape_string($paymentProof) . "', NOW(), '$grandTotal')";
        
        if ($conn->query($sqlPayment)) {
            echo json_encode(["success" => true, "orderID" => $orderID]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to save payment: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Failed to save order: " . $conn->error]);
    }
}
$conn->close();
?>