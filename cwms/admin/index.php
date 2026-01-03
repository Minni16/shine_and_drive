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
            // Check if user is admin
            if (isset($result->role) && $result->role == 'admin') {
                $_SESSION['alogin'] = $_POST['username'];
                $_SESSION['role'] = 'admin';
                echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
            } else {
                // Regular users cannot access admin panel
                echo "<script>alert('Access Denied! Only administrators can access this panel.');</script>";
            }
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>


<!DOCTYPE HTML>
<html>
<head>
<title>CWMS | Admin Sign in</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<!-- <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' /> -->
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
            background: linear-gradient(135deg,rgb(92, 235, 79),rgb(41, 92, 48));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 1rem;
            font-weight: 600;
            color: #333;
        }

        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        label {
            font-weight: 500;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background:rgb(21, 230, 66);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background:rgb(78, 206, 19);
        }

        .back {
            margin-top: 10px;
        }

        .back a {
            text-decoration: none;
            color:rgb(25, 230, 52);
            font-weight: 500;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
<!-- //lined-icons -->
</head> 
<body>

<div class="container">
    <h2>Login</h2>
    <form method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
            <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
        </div>
        <button type="submit" class="btn" name="login">Sign In</button>
    </form>
    <div class="back">
        <a href="../index.php">Back to Home</a>
    </div>
</div>

</body>
</html>