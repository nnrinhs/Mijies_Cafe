<?php
include 'db_conn.php';
$sql = "SELECT * FROM customer ORDER BY custID DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>#CUST-" . str_pad($row['custID'], 3, '0', STR_PAD_LEFT) . "</td>";
        echo "<td>" . htmlspecialchars($row['custName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['custUsername']) . "</td>";
        echo "<td>" . htmlspecialchars($row['custEmail']) . "</td>";
        echo "<td>" . htmlspecialchars($row['custPhoneNo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['custAddress']) . "</td>";
        echo "<td>
                <button class='btn btn-sm btn-warning'><i class='fa fa-edit'></i></button>
                <button class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>Data not found.</td></tr>";
}
$conn->close();
?>