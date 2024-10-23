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

// Query for available blood units
$available_blood_sql = "SELECT COUNT(*) as available FROM donors WHERE available = 1";
$available_blood_result = $conn->query($available_blood_sql);
$available_blood = $available_blood_result->fetch_assoc()['available'];

echo "<h2>Real-Time Blood Donation Statistics </h2>";
echo "<p>Total Donors: $total_donors</p>";
echo "<p>Available Blood Units: $available_blood</p>";
?>
