<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $last_donation = $_POST['last_donation'];

    $sql = "INSERT INTO donors (name, blood_group, city, contact_no, email, password, last_donation)
            VALUES ('$name', '$blood_group', '$city', '$contact_no', '$email', '$password', '$last_donation')";

    if ($conn->query($sql)) {
        $success_message = "Donor registered successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css"> <!-- Ensure this path is correct -->
    <title>Donor Registration</title>
</head>
<body>
    <div class="registration-container">
        <h2>Donor Registration</h2>
        <a href="../index.php" class="home-button">Home</a> <!-- Home Button -->
        <form method="POST" action="register.php">
            <input type="text" name="name" placeholder="Full Name" required>
            <label for="blood_group"></label>
            <select name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="contact_no" placeholder="Contact No" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <label for="last_donation">Last Donation Date:</label>
            <input type="date" name="last_donation">
            <button type="submit">Register</button>
        </form>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
