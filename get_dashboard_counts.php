<?php
header('Content-Type: application/json');

$host = "sql104.infinityfree.com";
$user = "if0_42353353";          
$pass = "Nurin2006";              
$db   = "if0_42353353_mijiescafe";   

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection Failed"]);
    exit;
}

try {

    $total_customers = $conn->query("SELECT COUNT(*) as total FROM customer")->fetch_assoc()['total'] ?? 0; 
    $total_menus     = $conn->query("SELECT COUNT(*) as total FROM menu")->fetch_assoc()['total'] ?? 0;
    $total_packages  = $conn->query("SELECT COUNT(*) as total FROM package")->fetch_assoc()['total'] ?? 0; 
    $total_orders    = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'] ?? 0; 

    $breakfast = $conn->query("SELECT COUNT(*) as total FROM menu WHERE TRIM(menuDetails) = 'Breakfast'")->fetch_assoc()['total'] ?? 0;
    $lunch     = $conn->query("SELECT COUNT(*) as total FROM menu WHERE TRIM(menuDetails) = 'Lunch'")->fetch_assoc()['total'] ?? 0;
    $drinks    = $conn->query("SELECT COUNT(*) as total FROM menu WHERE TRIM(menuDetails) = 'Drink'")->fetch_assoc()['total'] ?? 0; 


    $packages_list = [];
    $pkg_query = $conn->query("SELECT packageName, status FROM package ORDER BY packageID ASC"); 
    if ($pkg_query) {
        while ($row = $pkg_query->fetch_assoc()) {
            if (!empty($row['packageName'])) {
                $packages_list[] = [
                    "name"   => $row['packageName'],
                    "status" => $row['status'] 
                ];
            }
        }
    }

    $menus_out_of_stock = [];
    $menu_query = $conn->query("SELECT menuName FROM menu WHERE menuStatus = 'Out of Stock' ORDER BY menuID ASC");
    
    if ($menu_query) {
        while ($row = $menu_query->fetch_assoc()) {
            if (!empty($row['menuName'])) {
                $menus_out_of_stock[] = [
                    "name" => $row['menuName']
                ];
            }
        }
    }

    echo json_encode([
        "success"   => true,
        "customers" => (int)$total_customers, 
        "menus"     => (int)$total_menus,
        "packages"  => (int)$total_packages, 
        "orders"    => (int)$total_orders,
        "breakfast" => (int)$breakfast,
        "lunch"     => (int)$lunch,
        "drinks"    => (int)$drinks,
        "packages_list" => $packages_list,
        "menus_out_of_stock" => $menus_out_of_stock 
    ]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
$conn->close();
?>