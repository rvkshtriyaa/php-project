<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM donors WHERE email = '$email'";
    $result = $conn->query($sql);
    $donor = $result->fetch_assoc();

    if ($donor && password_verify($password, $donor['password'])) {
        session_start();
        $_SESSION['donor_id'] = $donor['id'];
        header('Location: dashboard.php');
    } else {
        echo "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
    <title>Donor Login</title>
</head>
<body>
    <h2>Donor Login</h2>
    <form method="POST" action="login.php">
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Password:</label><input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
