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
        /* Main content layout */
        .dashboard-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px;
        }

        /* Box styling */
        .dashboard-box {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard-box h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .dashboard-box p {
            font-size: 18px;
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
