<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Blood Bank - Home</title>
    <style>

        
        /* Body background with a semi-transparent overlay */
        body {
            background-image: url('assets/blood.jpeg'); /* Replace with the correct path */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Segoe UI', Tahoma, Geneva, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Semi-transparent overlay to improve readability */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
     
        /* Header styling */
        header {
            text-align: center;
            padding: 20px;
            color: #ffffff;
            background: rgba(34, 34, 34, 0.8); /* Dark grey with transparency */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        header h1 {
            font-size: 2.5em;
            margin: 0;
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 10px 0 0;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Main content layout */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .box {
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .box h2 {
            text-align: center;
            color: #D32F2F;
            font-size: 1.8em;
            margin-bottom: 15px;
        }

        /* Table styling for data display */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 1em;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #E57373;
            color: #fff;
        }

        td {
            background-color: #FAFAFA;
            color: #555;
        }

        /* Footer styling */
        footer {
            text-align: center;
            padding: 15px;
            background: rgba(34, 34, 34, 0.8); /* Dark grey with transparency */
            color: #ffffff;
            font-size: 1em;
            position: absolute;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    
    <header>
        <h1>BloodBuddy - An Online Blood Bank</h1>
        <nav>
            <ul>
                <li><a href="php/register.php">Donor Registration</a></li>
                <li><a href="php/find_donors.php">Find Donors</a></li>
                <li><a href="php/blood_camps.php">Blood Camps</a></li>
                <li><a href="php/request_blood.php">Request Blood</a></li>
               
                <li><a href="php/admin_login.php">Admin Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="main-content">
            <!-- Statistics Panel -->
            <section class="box statistics">
                <h2>Blood Availability</h2>
                <table>
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
                    $sql = "SELECT * FROM blood_requests ORDER BY id DESC LIMIT 5";
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

   
</body>
</html>

