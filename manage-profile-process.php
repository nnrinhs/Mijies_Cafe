<?php
session_start();
include('db_conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $current_cust_id = $_POST['current_cust_id'];
    $new_cust_id = trim($_POST['custID']);
    $custName = trim($_POST['custName']);

    // Validate
    if (empty($custName)) {
        die("<script>alert('Please fill in the name.'); window.history.back();</script>");
    }

    $query = "UPDATE customer SET custID = ?, custName = ?";
    $params = [$new_cust_id, $custName];
    $types  = "ss";

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $picture = time() . "_" . basename($_FILES['picture']['name']);
        $uploadDir = __DIR__ . '/assets/profile/'; 
        
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadDir . $picture)) {
            $query .= ", custProfilePic = ?";
            $params[] = $picture;
            $types .= "s";
        }
    }

    // Proses Password
if (!empty($_POST['custPassword'])) {
    $hashedPassword = password_hash($_POST['custPassword'], PASSWORD_DEFAULT);
    $query .= ", custPassword = ?";
    $params[] = $hashedPassword;
    $types .= "s";
}

    $query .= " WHERE custID = ?";
    $params[] = $current_cust_id;
    $types .= "s";

    $stmt = $condb->prepare($query);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $_SESSION['custName'] = $custName;
        $_SESSION['custID'] = $new_cust_id;
        echo "<script>alert('Successfully updated!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Fail to update.'); window.history.back();</script>";
    }
}
?>