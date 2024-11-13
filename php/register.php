<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $last_donation = $_POST['last_donation'];

    $sql = "INSERT INTO donors (name, blood_group, city, contact_no, email, password, last_donation)
            VALUES ('$name', '$blood_group', '$city', '$contact_no', '$email', '$password', '$last_donation')";

    if ($conn->query($sql)) {
        $success_message = "Donor registered successfully!";
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
    <title>Donor Registration</title>
    <style>
        /* Add styles for the navigation bar */
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

        .registration-container {
            width: 450px;
            margin: 100px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .registration-container h2 {
            color: #b22222;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        .registration-container input,
        .registration-container select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .registration-container input:focus,
        .registration-container select:focus {
            border-color: #b22222;
            outline: none;
        }

        .registration-container button {
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

        .registration-container button:hover {
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

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
        }

        /* Popup Modal Style */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .popup button {
            background-color: #b22222;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #900000;
        }
    </style>
</head>
<body>

    <!-- Add Navigation Bar -->
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="find_donors.php">Find Donors</a></li>
            <li><a href="blood_camps.php">Blood Camps</a></li>
            <li><a href="request_blood.php">Request Blood</a></li>
            <li><a href="admin_login.php">Admin Login</a></li>
        </ul>
    </nav>

    <!-- Registration Form -->
    <div class="registration-container">
        <h2>Donor Registration</h2>
        <form method="POST" action="register.php">
            <input type="text" name="name" placeholder="Full Name" required>
            <select name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="contact_no" placeholder="Contact No" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <label for="last_donation">Last Donation Date:</label>
            <input type="date" name="last_donation">
            <button type="submit">Register</button>
        </form>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>

    <!-- Success Popup -->
    <div id="successPopup" class="popup">
        <div class="popup-content">
            <h3>Success!</h3>
            <p>Your registration was successful. Thank you for registering as a blood donor.</p>
            <button onclick="closePopup()">Close</button>
        </div>
    </div>

    <script>
        // Check if the success message is set and show the popup
        <?php if (isset($success_message)): ?>
            window.onload = function() {
                document.getElementById('successPopup').style.display = 'flex';
            };
        <?php endif; ?>

        // Close the popup when clicking the button
        function closePopup() {
            document.getElementById('successPopup').style.display = 'none';
        }
    </script>

</body>
</html>
