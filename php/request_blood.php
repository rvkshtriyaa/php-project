<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipient_name = $_POST['recipient_name'];
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];
    $contact_no = $_POST['contact_no'];
    $message = $_POST['message'];

    $sql = "INSERT INTO blood_requests (recipient_name, blood_group, city, contact_no, message)
            VALUES ('$recipient_name', '$blood_group', '$city', '$contact_no', '$message')";

    if ($conn->query($sql)) {
        echo "Blood request submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
    <title>Request Blood</title>
</head>
<body>
    <h2>Request Blood</h2>
    <form method="POST" action="request_blood.php">
        <label>Recipient Name:</label><input type="text" name="recipient_name" required><br>
        <label>Blood Group:</label><input type="text" name="blood_group" required><br>
        <label>City:</label><input type="text" name="city" required><br>
        <label>Contact No:</label><input type="text" name="contact_no" required><br>
        <label>Message:</label><textarea name="message" required></textarea><br>
        <button type="submit">Submit Request</button>
    </form>
</body>
</html>
