<?php
include '../includes/config.php';

$sql = "SELECT * FROM blood_requests ORDER BY id DESC";
$result = $conn->query($sql);

echo "<h2>Latest Blood Requests</h2>";
if ($result->num_rows > 0) {
    echo "<table><tr><th>Recipient Name</th><th>Blood Group</th><th>City</th><th>Contact No</th><th>Message</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['recipient_name']}</td><td>{$row['blood_group']}</td><td>{$row['city']}</td><td>{$row['contact_no']}</td><td>{$row['message']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "No notifications!";
}
?>
