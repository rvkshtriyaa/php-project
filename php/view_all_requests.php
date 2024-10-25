<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

include '../includes/config.php';

// Fetch all blood requests
$sql = "SELECT * FROM blood_requests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>View All Requests</title>
    <style>
        .requests-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .back-button {
            margin: 20px;
            text-align: center;
        }
        .back-button a {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>View All Requests</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="view_donors.php">View Donors</a></li>
                <li><a href="manage_blood_camps.php">Manage Blood Camps</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <table class="requests-table">
            <tr>
                <th>Recipient Name</th>
                <th>Blood Group</th>
                <th>City</th>
                <th>Contact No</th>
                <th>Status</th>
                <th>Action</th> <!-- Added Action Column -->
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['recipient_name']}</td>
                            <td>{$row['blood_group']}</td>
                            <td>{$row['city']}</td>
                            <td>{$row['contact_no']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <a href='view_all_requests.php?delete_id={$row['id']}' class='delete-button' onclick=\"return confirm('Are you sure you want to delete this request?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No blood requests found!</td></tr>";
            }
            ?>
        </table>

        <div class="back-button">
            <a href="admin_dashboard.php">Back to Dashboard</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Online Blood Bank. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
// Check for delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM blood_requests WHERE id = ?";
    
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Blood request deleted successfully.'); window.location.href='view_all_requests.php';</script>";
    } else {
        echo "<script>alert('Error deleting blood request.'); window.location.href='view_all_requests.php';</script>";
    }
}
?>
