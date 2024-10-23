<?php
include 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Blood Bank - Home</title>
</head>
<body>
    <header>
        <h1>Welcome to the Online Blood Bank</h1>
        <nav>
            <ul>
                <li><a href="php/register.php">Donor Registration</a></li>
                <li><a href="php/find_donors.php">Find Donors</a></li>
                <li><a href="php/blood_camps.php">Blood Camps</a></li>
                <li><a href="php/request_blood.php">Request Blood</a></li>
                <li><a href="php/login.php">Donor Login</a></li>
                <li><a href="php/admin_login.php">Admin Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="statistics">
            <h2>Real-Time Blood Donation Statistics</h2>
            <?php include 'php/statistics.php'; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Online Blood Bank. All rights reserved.</p>
    </footer>
</body>
</html>
