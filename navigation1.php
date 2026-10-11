<nav style="background-color: #2c3e50; padding: 20px; color: white; display: flex; justify-content: center; gap: 30px; font-family: Arial, sans-serif;">
    <a href="index.php" style="color: white; text-decoration: none; font-weight: bold;">Home</a>
    
    <?php 
    // Mula semak jika session sudah wujud
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['cust_logged_in']) && $_SESSION['cust_logged_in'] === true): ?>
        <a href="manageprofile.php" style="color: white; text-decoration: none; font-weight: bold;">Edit Profile</a>
        <a href="logout.php" style="color: white; text-decoration: none; font-weight: bold;">Logout</a>
    <?php else: ?>
        <a href="login.php" style="color: white; text-decoration: none; font-weight: bold;">Login</a>
    <?php endif; ?>
</nav>