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
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto py-0 pe-4">
                            <a href="indexC.html" class="nav-item nav-link">Home</a>
                            <a href="aboutC.html" class="nav-item nav-link">About</a>
                            <a href="menuC.html" class="nav-item nav-link">Menu</a>
                        </div>
                        <a href="logout.php" class="btn btn-primary ms-3">Logout</a>
                    </div>
                </nav>
            </div>
            
            <div class="container-fluid py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3">My Account</h1>
                </div>
            </div>
        </div>
        
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="bg-dark text-white rounded p-4 text-center shadow">
                        <div class="mb-3">
                            <i class="fa fa-user-circle fa-5x text-primary"></i>
                        </div>
                        <h4 class="text-white mb-1"><?php echo htmlspecialchars($user['custName'] ?? ''); ?></h4>
                        <p class="text-primary mb-4">@<?php echo htmlspecialchars($user['custUsername'] ?? ''); ?></p>
                        <hr class="bg-light">
                        <div class="text-start small px-2">
                            <p class="mb-2"><strong>Account ID:</strong> #<?php echo $user['custID'] ?? ''; ?></p>
                            <p class="mb-2"><strong>Email:</strong> <?php echo htmlspecialchars($user['custEmail'] ?? ''); ?></p>
                            <p class="mb-2"><strong>Phone No:</strong> <?php echo htmlspecialchars($user['custPhoneNo'] ?? ''); ?></p>
                            <p class="mb-0"><strong>Address:</strong> <?php echo htmlspecialchars($user['custAddress'] ?? ''); ?></p>
                        </div>
                        <a href="edit_profile.php" class="btn btn-primary w-100 mt-4">Update Profile</a>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow p-4 border-0">
                        <h3 class="mb-4 text-dark border-bottom pb-2"><i class="fa fa-history me-2 text-primary"></i>Order History</h3>
                        
                        <?php if(!$history_result || $history_result->num_rows == 0): ?>
                            <div class="alert alert-light text-center py-5 border">
                                <i class="fa fa-shopping-basket fa-3x mb-3 text-muted"></i>
                                <p class="mb-0 text-muted fst-italic">You haven't made any bookings or orders yet.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover text-start align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Details</th>
                                            <th>Order Date</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while($row = $history_result->fetch_assoc()): ?>
                                        <tr>
                                            <td><strong>#ORD-<?php echo $row['orderID']; ?></strong></td>
                                            <td><small><?php echo nl2br(htmlspecialchars($row['orderDetail'] ?? '')); ?></small></td>
                                            <td>
                                                <?php 
                                                    $dateRaw = $row['orderDate'];
                                                    echo (strlen($dateRaw) <= 10) ? date('d-m-Y', strtotime($dateRaw)) : date('d-m-Y h:i A', strtotime($dateRaw));
                                                ?>
                                            </td>
                                            <td class="text-primary fw-bold">RM <?php echo number_format($row['totalPrice'], 2); ?></td>
                                            <td>
												<?php 
													$currentStatus = isset($row['orderStatus']) ? trim($row['orderStatus']) : ""; 
													
													if (empty($currentStatus) || $currentStatus === "Pending") {
														$currentStatus = "Preparing";
													}

													if ($currentStatus === "Completed") {
														$badgeClass = 'badge-completed'; // Hijau
													} elseif ($currentStatus === "Ready") {
														$badgeClass = 'badge-ready';     // Biru
													} else {
														$badgeClass = 'badge-preparing'; // Oren (Preparing)
													}
												?>
												<span class="badge <?php echo $badgeClass; ?> px-3 py-2">
													<?php echo htmlspecialchars($currentStatus); ?>
												</span>
											</td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>