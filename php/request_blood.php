<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipient_name = $_POST['recipient_name'];
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];
    $contact_no = $_POST['contact_no'];
    $message = $_POST['message'];

    $sql = "INSERT INTO blood_requests (recipient_name, blood_group, city, contact_no, message)
            VALUES ('$recipient_name', '$blood_group', '$city', '$contact_no', '$message')";

    if ($conn->query($sql)) {
        $success_message = "Blood request submitted successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Request Blood</title>
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

        .request-blood-container {
            width: 450px;
            margin: 100px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .request-blood-container h2 {
            color: #b22222;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        .request-blood-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
        }

        .request-blood-container input,
        .request-blood-container textarea,
        .request-blood-container select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .request-blood-container input:focus,
        .request-blood-container textarea:focus,
        .request-blood-container select:focus {
            border-color: #b22222;
            outline: none;
        }

        .request-blood-container button {
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

        .request-blood-container button:hover {
            background-color: #900000;
        }

        .success {
            color: green;
            margin-top: 20px;
        }

        .error {
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
            <li><a href="login.php">Donor Login</a></li>
            <li><a href="admin_login.php">Admin Login</a></li>
        </ul>
    </nav>

    <!-- Request Blood Form -->
    <div class="request-blood-container">
        <h2>Request Blood</h2>
        <form method="POST" action="request_blood.php">
            <label>Recipient Name:</label>
            <input type="text" name="recipient_name" required>
            <label>Blood Group:</label>
            <select name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
            <label>City:</label>
            <input type="text" name="city" required>
            <label>Contact No:</label>
            <input type="text" name="contact_no" required>
            <label>Message:</label>
            <textarea name="message" required></textarea>
            <button type="submit">Submit Request</button>
        </form>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

