<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

include '../includes/config.php';

// Handle add blood camp request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_camp'])) {
    $camp_name = $_POST['camp_name'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $contact_no = $_POST['contact_no'];

    $insert_sql = "INSERT INTO blood_camps (camp_name, date, location, contact_no) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssss", $camp_name, $date, $location, $contact_no);
    
    if ($stmt->execute()) {
        echo "<script>alert('Blood camp added successfully.'); window.location.href='manage_blood_camps.php';</script>";
    } else {
        echo "<script>alert('Error adding blood camp.'); window.location.href='manage_blood_camps.php';</script>";
    }
}

// Handle delete blood camp request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $delete_sql = "DELETE FROM blood_camps WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Blood camp deleted successfully.'); window.location.href='manage_blood_camps.php';</script>";
    } else {
        echo "<script>alert('Error deleting blood camp.'); window.location.href='manage_blood_camps.php';</script>";
    }
}

// Fetch all blood camps
$sql = "SELECT * FROM blood_camps";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Manage Blood Camps</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        header {
            color: white;
            padding: 15px;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        h1 {
            margin-bottom: 20px;
        }
        .add-camp-form {
            margin: 20px auto;
            text-align: center;
            width: 90%;
            max-width: 500px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .add-camp-form h2 {
            color: #b22222;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
        }
        .add-camp-form input,
        .add-camp-form select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .add-camp-form input:focus,
        .add-camp-form select:focus {
            border-color: #b22222;
            outline: none;
        }
        .add-camp-form button {
            width: 100%;
            padding: 12px;
            background-color: #b22222;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        .add-camp-form button:hover {
            background-color: #900000;
        }
        .camps-table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #dc3545; /* Red border */
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #c82333; /* Darker red header */
            color: white;
        }
        .back-button {
            text-align: center;
            margin: 20px;
        }
        .back-button a {
            padding: 10px 20px;
            background-color: #dc3545; /* Red link */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-button a:hover {
            background-color: #c82333; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <header>
        <h1>Manage Blood Camps</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="view_donors.php">View Donors</a></li>
                <li><a href="view_all_requests.php">View All Requests</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="add-camp-form">
            <h2>Add New Blood Camp</h2>
            <form method="POST" action="">
                <input type="text" name="camp_name" placeholder="Camp Name" required>
                <input type="date" name="date" required>
                <input type="text" name="location" placeholder="Location" required>
                <input type="text" name="contact_no" placeholder="Contact No" required>
                <button type="submit" name="add_camp">Add Camp</button>
            </form>
        </div>

        <table class="camps-table">
            <tr>
                <th>Camps Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Contact No</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['camp_name']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['location']}</td>
                            <td>{$row['contact_no']}</td>
                            <td>
                                <a href='manage_blood_camps.php?delete_id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this blood camp?');\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No blood camps found!</td></tr>";
            }
            ?>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 Online Blood Bank. All rights reserved.</p>
    </footer>
</body>
</html>
