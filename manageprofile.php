<?php
session_start();
include('db_conn.php');

if (!isset($_SESSION['custID'])) {
    die("<script>
            alert('Please login first!.');
            window.location.href='login.php';
         </script>");
}

$current_cust_id = $_SESSION['custID'];

$query = "SELECT * FROM customer WHERE custID = ?"; 
$stmt = $conn->prepare($query);                
$stmt->bind_param("s", $current_cust_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    die("<script>
            alert('Data not found.');
            window.location.href='index.php';
         </script>");
}

$user = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manage Profile — Mijies Cafe</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include('navigation1.php'); ?>

<div class="main-wrap">
    <div class="content">
        <div class="login-style">
            <div class="profile-card">
                <h3>Manage Your Profile</h3>
                
                <?php if(!empty($user['custProfilePic'])): ?>
                    <div style="text-align:center; margin-bottom:1.5rem;">
                        <img src="assetsprofile/<?= htmlspecialchars($user['custProfilePic']) ?>" 
                             class="profile-preview" style="width:100px; height:100px; border-radius:50%;">
                    </div>
                <?php endif; ?>

                <form action="manage-profile-process.php" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="current_cust_id" value="<?= htmlspecialchars($user['custID']) ?>">

                    <div class="form-group">
                        <label>Profile Picture</label>
                        <input type="file" name="picture" accept="image/*" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Customer ID</label>
                        <input type="text" name="custID" class="form-control" readonly 
                               value="<?= htmlspecialchars($user['custID']) ?>">
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="custName" class="form-control" required 
                               value="<?= htmlspecialchars($user['custName']) ?>">
                    </div>

                    <div class="form-group">
                        <label>New Password (Optional)</label>
                        <input type="password" name="custPassword" class="form-control" 
                               placeholder="Leave blank to keep current password">
                    </div>

                    <button type="submit" class="btn-login">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</div>
</body>
</html>