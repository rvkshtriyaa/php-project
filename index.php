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
    <style>
        /* Grid layout for main content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px;
        }

        .box {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: auto;
        }

        .box h2 {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
        }

        /* Table styling for both sections */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            color: #555;
        }

        td {
            text-align: center;
            color: #333;
        }
    </style>
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
        <div class="main-content">
            <!-- Statistics Panel -->
            <section class="box statistics">
               
                <table>
                <H1></H1>
                    <tr>
                        <th>Blood Group</th>
                        <th>Available Units</th>
                    </tr>
                    <?php include 'php/statistics.php'; ?>
                </table>
            </section>

            <!-- Notification Panel for Latest Blood Requests -->
            <section class="box notifications">
                <h2>Latest Blood Requests</h2>
                <table>
                    <tr>
                        <th>Recipient Name</th>
                        <th>Blood Group</th>
                        <th>City</th>
                        <th>Contact No</th>
                        <th>Message</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM blood_requests ORDER BY id DESC LIMIT 5"; // Show latest 5 requests
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['recipient_name']}</td><td>{$row['blood_group']}</td><td>{$row['city']}</td><td>{$row['contact_no']}</td><td>{$row['message']}</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No recent blood requests!</td></tr>";
                    }
                    ?>
                </table>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Online Blood Bank. All rights reserved.</p>
    </footer>
</body>
</html>

