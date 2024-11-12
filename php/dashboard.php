<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

include '../includes/config.php';

// Fetch the total number of approved requests
$sql_approved_requests = "SELECT COUNT(*) as approved_requests FROM blood_requests WHERE status = 'approved'";
$result_approved_requests = $conn->query($sql_approved_requests);
$approved_requests = $result_approved_requests->fetch_assoc()['approved_requests'];

// Fetch the total number of pending requests
$sql_pending_requests = "SELECT COUNT(*) as pending_requests FROM blood_requests WHERE status = 'pending'";
$result_pending_requests = $conn->query($sql_pending_requests);
$pending_requests = $result_pending_requests->fetch_assoc()['pending_requests'];

// Fetch the total number of rejected requests
$sql_rejected_requests = "SELECT COUNT(*) as rejected_requests FROM blood_requests WHERE status = 'rejected'";
$result_rejected_requests = $conn->query($sql_rejected_requests);
$rejected_requests = $result_rejected_requests->fetch_assoc()['rejected_requests'];

// Fetch the total number of donors
$sql_total_donors = "SELECT COUNT(*) as total_donors FROM donors";
$result_total_donors = $conn->query($sql_total_donors);
$total_donors = $result_total_donors->fetch_assoc()['total_donors'];

// Fetch the total number of blood camps
$sql_total_camps = "SELECT COUNT(*) as total_camps FROM blood_camps";
$result_total_camps = $conn->query($sql_total_camps);
$total_camps = $result_total_camps->fetch_assoc()['total_camps'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Admin Dashboard</title>
    <style>
        /* Body background with a semi-transparent overlay */
        body {
            background-image: url('../assets/blood.jpeg'); /* Ensure correct path */
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

        /* Semi-transparent overlay for better readability */
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
        .dashboard-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
        }

        /* Box styling */
        .dashboard-box {
            padding: 20px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.85);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard-box h3 {
            margin-bottom: 15px;
            color: #D32F2F;
            font-size: 1.8em;
        }

        .dashboard-box p {
            font-size: 22px;
            margin: 5px 0;
            color: #555;
        }

        /* Home Button Styling */
        .home-button {
            text-align: center;
            margin-top: 30px;
        }

        .home-button a {
            padding: 12px 30px;
            background-color: #D32F2F;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .home-button a:hover {
            background-color: #218838;
            transform: translateY(-3px);
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
        <h1>Admin Dashboard - Blood Bank</h1>
        <nav>
            <ul>
                <li><a href="view_all_requests.php">View All Requests</a></li>
                <li><a href="view_donors.php">View Donors</a></li>
                <li><a href="manage_blood_camps.php">Manage Blood Camps</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="dashboard-content">
            <div class="dashboard-box">
                <h3>Total Approved Requests</h3>
                <p><?php echo $approved_requests; ?></p>
            </div>
            <div class="dashboard-box">
                <h3>Total Pending Requests</h3>
                <p><?php echo $pending_requests; ?></p>
            </div>
            <div class="dashboard-box">
                <h3>Total Rejected Requests</h3>
                <p><?php echo $rejected_requests; ?></p>
            </div>
            <div class="dashboard-box">
                <h3>Total Donors</h3>
                <p><?php echo $total_donors; ?></p>
            </div>
            <div class="dashboard-box">
                <h3>Total Blood Camps</h3>
                <p><?php echo $total_camps; ?></p>
            </div>
        </div>

        <!-- Home Button -->
        <div class="home-button">
            <a href="admin_home.php">Home</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Online Blood Bank. All rights reserved.</p>
    </footer>

</body>
</html>

