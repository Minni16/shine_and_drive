<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cwmsdb";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['username']);
    $pass = trim($_POST['password']);
    $encrypted = md5($pass); // Using MD5 (Not Recommended)

    // Check if the email is already registered
    $stmt = $conn->prepare("SELECT * FROM admin WHERE UserName=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $query = $stmt->get_result();

    if ($query->num_rows > 0) {
        echo '<script>alert("Username already used!!");</script>';
    } else {
        // Register as regular user (not admin)
        $userRole = 'user';
        $stmt = $conn->prepare("INSERT INTO admin (UserName, Password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $encrypted, $userRole);
        if ($stmt->execute()) {
            echo '<script>alert("You are registered as a regular user!!");</script>';
        } else {
            echo '<script>alert("REGISTRATION FAILED!!!");</script>';
        }
    }
    $stmt->close();
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        /* Import Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, rgba(124, 243, 100, 0.8), rgba(22, 114, 30, 0.8));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-attachment: fixed;
            overflow: hidden;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            backdrop-filter: blur(10px); /* Keep the blur effect in the background */
            transition: transform 0.3s ease;
        }

        h2 {
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: #333;
            font-size: 1.6rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        label {
            font-weight: 500;
            color: #555;
            font-size: 1rem;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: rgb(86, 209, 48);
            outline: none;
            box-shadow: 0 0 8px rgba(86, 209, 48, 0.5);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: rgb(86, 209, 48);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: rgb(73, 209, 46);
            transform: scale(1.05);
        }

        .back {
            margin-top: 20px;
        }

        .back a {
            text-decoration: none;
            color: rgb(55, 206, 41);
            font-weight: 500;
            font-size: 1.1rem;
        }

        .back a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                width: 80%;
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Sign Up</h2>
        <form method="post" action="register.php">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit" class="btn" name="register">Sign Up</button>
        </form>
        <div class="back">
            <a href="index.php">Back to Home</a>
        </div>
    </div>

</body>
</html>

