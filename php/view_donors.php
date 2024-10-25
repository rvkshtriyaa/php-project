<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

include '../includes/config.php';

// Check for delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM donors WHERE id = ?";
    
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Donor deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting donor.');</script>";
    }
}

// Fetch all donors
$sql = "SELECT * FROM donors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>View Donors</title>
    <style>
        .donors-table {
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
        
        .back-button a:hover {
            background-color: #0056b3;
        }
        .delete-button {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1>View Donors</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="view_all_requests.php">View All Requests</a></li>
                <li><a href="manage_blood_camps.php">Manage Blood Camps</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <table class="donors-table">
            <tr>
                <th>Name</th>
                <th>Blood Group</th>
                <th>Contact No</th>
                <th>City</th>
                <th>Action</th> <!-- Added Action Column -->
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['blood_group']}</td>
                            <td>{$row['contact_no']}</td>
                            <td>{$row['city']}</td>
                            <td><a href='view_donors.php?delete_id={$row['id']}' class='delete-button' onclick=\"return confirm('Are you sure you want to delete this donor?');\">Delete</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No donors found!</td></tr>";
            }
            ?>
        </table>

    </main>

    <footer>
        <p>&copy; 2024 Online Blood Bank. All rights reserved.</p>
    </footer>
</body>
</html>
