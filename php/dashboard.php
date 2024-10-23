<?php
session_start();
if (!isset($_SESSION['donor_id'])) {
    header('Location: login.php');
}

include '../includes/config.php';

$donor_id = $_SESSION['donor_id'];
$sql = "SELECT * FROM donors WHERE id = '$donor_id'";
$result = $conn->query($sql);
$donor = $result->fetch_assoc();

echo "<h2>Welcome, " . $donor['name'] . "!</h2>";
echo "<p>Blood Group: " . $donor['blood_group'] . "</p>";
echo "<p>City: " . $donor['city'] . "</p>";
echo "<p>Contact No: " . $donor['contact_no'] . "</p>";
?>
