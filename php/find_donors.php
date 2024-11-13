<?php
include '../includes/config.php';

$show_popup = false;  // Flag for popup display

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];

    $sql = "SELECT * FROM donors WHERE blood_group = '$blood_group' AND city = '$city' AND available = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $donors_data = [];  // Array to store donor details
        while ($row = $result->fetch_assoc()) {
            $donors_data[] = $row;  // Store each donor data
        }
        $show_popup = true;  // Flag to trigger popup
    } else {
        $error_message = "No donors found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Find Donors</title>
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

        .find-donors-container {
            width: 450px;
            margin: 100px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .find-donors-container h2 {
            color: #b22222;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        .find-donors-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
        }

        .find-donors-container select,
        .find-donors-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .find-donors-container select:focus,
        .find-donors-container input:focus {
            border-color: #b22222;
            outline: none;
        }

        .find-donors-container button {
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

        .find-donors-container button:hover {
            background-color: #900000;
        }

        /* Table Styles */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #b22222;
            color: white;
        }

        .error {
            color: red;
            margin-top: 20px;
        }

        .success {
            margin-top: 20px;
        }

        /* Popup Style */
        .popup {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            z-index: 1000;
            width: 300px;
        }

        .popup h3 {
            margin-top: 0;
            color: #b22222;
        }

        .popup button {
            padding: 10px 20px;
            background-color: #b22222;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #900000;
        }

        /* Overlay behind the popup */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="register.php">Donor Registration</a></li>
            <li><a href="blood_camps.php">Blood Camps</a></li>
            <li><a href="request_blood.php">Request Blood</a></li>
            <li><a href="admin_login.php">Admin Login</a></li>
        </ul>
    </nav>

    <!-- Find Donors Form -->
    <main>
        <div class="find-donors-container">
            <h2>Find Donors</h2>
            <form method="POST" action="find_donors.php">
                <label for="blood_group">Blood Group:</label>
                <select name="blood_group" id="blood_group" required>
                    <option value="" disabled selected>Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
                <label for="city">City:</label>
                <input type="text" name="city" id="city" required>
                <button type="submit">Find Donors</button>
            </form>

            <?php if (isset($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            
            <?php if ($show_popup && isset($donors_data)): ?>
                <!-- Donors Table -->
                <div class="success">
                    <table>
                        <tr><th>Name</th><th>Contact No</th><th>Email</th></tr>
                        <?php foreach ($donors_data as $donor): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($donor['name']); ?></td>
                                <td><?php echo htmlspecialchars($donor['contact_no']); ?></td>
                                <td><?php echo htmlspecialchars($donor['email']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <!-- Popup Message -->
                <div class="overlay" id="overlay"></div>
                <div class="popup" id="popup">
                    <h3>Donors Found!</h3>
                    <p>We found <?php echo count($donors_data); ?> donors in your area.</p>
                    <button onclick="closePopup()">Close</button>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- JavaScript for Popup -->
    <script>
        // Show popup if donors are found
        <?php if ($show_popup): ?>
            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        <?php endif; ?>

        // Function to close the popup
        function closePopup() {
            document.getElementById("popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
    </script>

</body>
</html>
