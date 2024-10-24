<?php
include '../includes/config.php';

$sql = "SELECT * FROM blood_camps";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Blood Donation Camps</title>
    <style>
        /* Navigation Bar Styles */
        nav {
            background-color: #b22222;
            padding: 15px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #900000;
        }

        .camps-container {
            width: 80%;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .camps-container h2 {
            color: #b22222;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #b22222;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .no-camps {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="register.php">Donor Registration</a></li>
            <li><a href="find_donors.php">Find Donors</a></li>
            <li><a href="blood_camps.php">Blood Camps</a></li>
            <li><a href="request_blood.php">Request Blood</a></li>
            <li><a href="login.php">Donor Login</a></li>
            <li><a href="admin_login.php">Admin Login</a></li>
        </ul>
    </nav>

    <!-- Blood Camps Table -->
    <div class="camps-container">
        <h2>Upcoming Blood Donation Camps</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Camp Name</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Contact</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['camp_name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['time']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p class="no-camps">No camps scheduled!</p>
        <?php endif; ?>
    </div>
</body>
</html>
