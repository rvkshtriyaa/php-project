<?php
include '../includes/config.php';

$sql = "SELECT * FROM blood_camps";
$result = $conn->query($sql);

echo "<h2>Upcoming Blood Donation Camps</h2>";
if ($result->num_rows > 0) {
    echo "<table><tr><th>Camp Name</th><th>Location</th><th>Date</th><th>Time</th><th>Contact</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['camp_name']}</td><td>{$row['location']}</td><td>{$row['date']}</td><td>{$row['time']}</td><td>{$row['contact']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "No camps scheduled!";
}
?>
