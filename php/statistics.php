<?php
// Correct the path to config.php (remove ../)
$file = 'includes/config.php';
if (!file_exists($file)) {
    die("Config file not found at: $file");
}

include $file;

// Query for total donors
$total_donors_sql = "SELECT COUNT(*) as total FROM donors";
$total_donors_result = $conn->query($total_donors_sql);
$total_donors = $total_donors_result->fetch_assoc()['total'];

// Query for available blood units (total)
$available_blood_sql = "SELECT COUNT(*) as available FROM donors WHERE available = 1";
$available_blood_result = $conn->query($available_blood_sql);
$available_blood = $available_blood_result->fetch_assoc()['available'];

// Query for available blood units by blood group
$blood_group_sql = "SELECT blood_group, COUNT(*) as units FROM donors WHERE available = 1 GROUP BY blood_group";
$blood_group_result = $conn->query($blood_group_sql);

echo "<h2>Real-Time Blood Donation Statistics </h2>";
echo "<p>Total Donors: $total_donors</p>";
echo "<p>Available Blood Units: $available_blood</p>";

echo "<h2>Available Blood Units by Blood Group</h2>";


if ($blood_group_result->num_rows > 0) {
    while ($row = $blood_group_result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['blood_group']}</td>
                <td>{$row['units']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='2'>No blood units available!</td></tr>";
}

echo "</table>";
?>
