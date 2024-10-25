<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM donors WHERE email = '$email'";
    $result = $conn->query($sql);
    $donor = $result->fetch_assoc();

    if ($donor && password_verify($password, $donor['password'])) {
        session_start();
        $_SESSION['donor_id'] = $donor['id'];
        header('Location: dashboard.php');
        exit();
    } else {
        $error_message = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Donor Login</title>
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

        .login-container {
            width: 450px;
            margin: 100px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h2 {
            color: #b22222;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .login-container input:focus {
            border-color: #b22222;
            outline: none;
        }

        .login-container button {
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

        .login-container button:hover {
            background-color: #900000;
        }

        .error {
            color: red;
            margin-top: 20px;
        }

        .password-container {
            position: relative;
            width: 100%;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 12px;
            cursor: pointer;
            font-size: 18px; /* Adjust icon size */
            color: #b22222;
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.remove('fa-eye');
                toggleButton.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.remove('fa-eye-slash');
                toggleButton.classList.add('fa-eye');
            }
        }
    </script>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <ul>
        <li><a href="../index.php">Home</a></li>
            <li><a href="register.php">Donor Registration</a></li>
            <li><a href="find_donors.php">Find Donors</a></li>
            <li><a href="blood_camps.php">Blood Camps</a></li>
            <li><a href="request_blood.php">Request Blood</a></li>
            <li><a href="admin_login.php">Admin Login</a></li>
        </ul>
    </nav>

    <!-- Donor Login Form -->
    <div class="login-container">
        <h2>Donor Login</h2>
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
                <span id="togglePassword" class="toggle-password fa fa-eye" onclick="togglePasswordVisibility()"></span>
            </div>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
