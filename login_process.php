<?php
session_start();
header('Content-Type: application/json');

if (file_exists('db_conn.php')) {
    include 'db_conn.php';
} else {
    $conn = new mysqli("localhost", "root", "", "mijies_cafe");
}

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($username) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Please fill in the Username and Password!"]);
        exit;
    }

    //staff
    $sql_staff = "SELECT staffID, staffName, staffPosition FROM staff WHERE staffUsername = ? AND staffPassword = ?";
    $stmt_staff = $conn->prepare($sql_staff);
    
    if ($stmt_staff) {
        $stmt_staff->bind_param("ss", $username, $password);
        $stmt_staff->execute();
        $result_staff = $stmt_staff->get_result();

        if ($result_staff->num_rows === 1) {
            $staff = $result_staff->fetch_assoc();
            
            $_SESSION['staff_logged_in'] = true;
            $_SESSION['user_id'] = $staff['staffID'];
            $_SESSION['user_name'] = $staff['staffName'];
            $_SESSION['staff_position'] = $staff['staffPosition'];
            $_SESSION['role'] = 'staff';

            session_write_close(); 

            echo json_encode([
                "success" => true, 
                "role" => "staff",
                "message" => "Login successful! Welcome Staff " . $staff['staffName'],
                "redirect" => "admin.html"
            ]);
            
            $stmt_staff->close();
            $conn->close();
            exit; 
        }
        $stmt_staff->close();
    }

    $sql_cust = "SELECT custID, custName, custPhoneNo FROM customer WHERE custUsername = ? AND custPassword = ?";
    $stmt_cust = $conn->prepare($sql_cust);
    
    if ($stmt_cust) {
        $stmt_cust->bind_param("ss", $username, $password);
        $stmt_cust->execute();
        $result_cust = $stmt_cust->get_result();

        if ($result_cust->num_rows === 1) {
            $customer = $result_cust->fetch_assoc();
            
            $_SESSION['cust_logged_in'] = true;
            $_SESSION['user_id'] = $customer['custID'];
            $_SESSION['custID'] = $customer['custID']; 
            $_SESSION['user_name'] = $customer['custName'];
            $_SESSION['custName'] = $customer['custName'];
            $_SESSION['custPhoneNo'] = $customer['custPhoneNo']; 
            
            $_SESSION['role'] = 'customer';

            session_write_close(); 

            echo json_encode([
                "success" => true, 
                "role" => "customer",
                "message" => "Login successful! Welcome " . $customer['custName'],
                "redirect" => "menu.html" 
            ]);
            
            $stmt_cust->close();
            $conn->close();
            exit; 
        }
        $stmt_cust->close();
    }
	
    echo json_encode(["success" => false, "message" => "Username or Password incorrect! Access denied."]);

} else {
    echo json_encode(["success" => false, "message" => "Method rejected."]);
}

$conn->close();
?>