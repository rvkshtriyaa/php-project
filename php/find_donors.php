<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];

    $sql = "SELECT * FROM donors WHERE blood_group = '$blood_group' AND city = '$city' AND available = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>Name</th><th>Contact No</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['name']}</td><td>{$row['contact_no']}</td><td>{$row['email']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No donors found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
    <title>Find Donors</title>
</head>
<body>
    <h2>Find Donors</h2>
    <form method="POST" action="find_donors.php">
        <label>Blood Group:</label><input type="text" name="blood_group" required><br>
        <label>City:</label><input type="text" name="city" required><br>
        <button type="submit">Find Donors</button>
    </form>
</body>
</html>
