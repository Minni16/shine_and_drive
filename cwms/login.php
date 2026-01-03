<?php
session_start();
include('includes/config.php');

if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']); // MD5 Hashing the password

    // Check if the user exists and get their role
    $sql = "SELECT UserName, Password, role FROM admin WHERE UserName = :uname";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if ($result) {
        // Check if the hashed password matches the stored password
        if ($result->Password == $password) {
            // Set session for both admin and regular users
            $_SESSION['alogin'] = $_POST['username'];
            $_SESSION['role'] = $result->role;
            
            // Redirect based on role
            if (isset($result->role) && $result->role == 'admin') {
                // Admin goes to admin dashboard
                echo "<script type='text/javascript'> document.location = 'admin/dashboard.php'; </script>";
            } else {
                // Regular users go to homepage
                echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
            }
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Car Wash Management System</title>
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
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            backdrop-filter: blur(10px);
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

        .links {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .links a {
            text-decoration: none;
            color: rgb(55, 206, 41);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .admin-link {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }

        .admin-link a {
            color: #666;
            font-size: 0.85rem;
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
        <h2>User Login</h2>
        <form method="post" action="login.php">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit" class="btn" name="login">Sign In</button>
        </form>
        <div class="links">
            <a href="register.php">Create Account</a>
            <a href="index.php">Back to Home</a>
        </div>
        <div class="admin-link">
            <a href="admin/index.php">Admin Login</a>
        </div>
    </div>

</body>
</html>

