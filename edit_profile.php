<?php
session_start();

date_default_timezone_set('Asia/Kuala_Lumpur');

if(!isset($_SESSION['cust_logged_in']) || $_SESSION['cust_logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

if (file_exists('db_conn.php')) {
    include 'db_conn.php';
} else {
    $conn = new mysqli("localhost", "root", "", "mijies_cafe");
}

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$custID = $_SESSION['custID'];
$success_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName     = trim($_POST['custName']);
    $newEmail    = trim($_POST['custEmail']);
    $newPhone    = trim($_POST['custPhoneNo']);
    $newAddress  = trim($_POST['custAddress']);
    $newPassword = $_POST['custPassword'] ?? '';
    
    if (empty($newName) || empty($newEmail) || empty($newPhone)) {
        $error_msg = "Name, Email, and Phone Number fields are required!";
    } else {
        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            $update_sql = "UPDATE customer SET custName = ?, custEmail = ?, custPhoneNo = ?, custAddress = ?, custPassword = ? WHERE custID = ?";
            $stmt_update = $conn->prepare($update_sql);
            $stmt_update->bind_param("sssssi", $newName, $newEmail, $newPhone, $newAddress, $hashedPassword, $custID);
        } else {

            $update_sql = "UPDATE customer SET custName = ?, custEmail = ?, custPhoneNo = ?, custAddress = ? WHERE custID = ?";
            $stmt_update = $conn->prepare($update_sql);
            $stmt_update->bind_param("ssssi", $newName, $newEmail, $newPhone, $newAddress, $custID);
        }
        
        if ($stmt_update->execute()) {
            $success_msg = "Profile updated successfully!";
        } else {
            $error_msg = "Failed to update database record: " . $conn->error;
        }
        $stmt_update->close();
    }
}

$sql = "SELECT * FROM customer WHERE custID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $custID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mijies Cafe - My Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <style>
        .badge-preparing { background: #fd7e14; color: #fff; } 
        .badge-ready { background: #007bff; color: #fff; }     
        .badge-completed { background: #28a745; color: #fff; } 
    </style>
</head>
<body>
    <div class="container-fluid bg-white p-0">
        <div class="container-fluid p-0">
            <div class="container position-relative p-0">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3 py-lg-0">
                    <a href="indexC.html" class="navbar-brand p-0">
                        <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Mijies Cafe</h1>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                </nav>
            </div>
            
            <div class="container-fluid py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-3 pb-2">
                    <h1 class="display-3 text-white mb-3">Edit Profile</h1>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow p-4 border-0">
                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                            <h4 class="text-dark m-0"><i class="fa fa-user-edit text-primary me-2"></i>Update Account Details</h4>
                            <a href="profile.php" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left me-1"></i> Back to Profile</a>
                        </div>

                        <?php if(!empty($success_msg)): ?>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fa fa-check-circle me-2"></i> <?php echo $success_msg; ?>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($error_msg)): ?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="fa fa-exclamation-triangle me-2"></i> <?php echo $error_msg; ?>
                            </div>
                        <?php endif; ?>

                        <form action="edit_profile.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Full Name</label>
                                <input type="text" name="custName" class="form-control p-3 shadow-sm" value="<?php echo htmlspecialchars($user['custName'] ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Email Address</label>
                                <input type="email" name="custEmail" class="form-control p-3 shadow-sm" value="<?php echo htmlspecialchars($user['custEmail'] ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Phone Number</label>
                                <input type="text" name="custPhoneNo" class="form-control p-3 shadow-sm" value="<?php echo htmlspecialchars($user['custPhoneNo'] ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">New Password</label>
                                <input type="password" name="custPassword" class="form-control p-3 shadow-sm" placeholder="••••••••">
                                <div class="form-text text-muted small mt-1"><i class="fa fa-info-circle me-1"></i> Leave empty if you do not want to change your password.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">Delivery/Billing Address</label>
                                <textarea name="custAddress" class="form-control p-3 shadow-sm" rows="3"><?php echo htmlspecialchars($user['custAddress'] ?? ''); ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 p-3 fw-bold text-uppercase"><i class="fa fa-save me-2"></i> Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>