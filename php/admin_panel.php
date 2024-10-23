<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
}

include '../includes/config.php';

$sql = "SELECT * FROM donors";
$result = $conn->query($sql);

echo "<h2>Donors List</h2>";
if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th><th>Blood Group</th><th>City</th><th>Contact No</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['name']}</td><td>{$row['blood_group']}</td><td>{$row['city']}</td><td>{$row['contact_no']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "No donors found!";
}
?>
