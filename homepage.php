<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimePulse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #d3d3d3;
        }
        header .logo {
            display: flex;
            align-items: center;
        }
        header .logo img {
            width: 40px;
            margin-right: 10px;
        }
        header nav a {
            text-decoration: none;
            color: black;
            margin: 0 10px;
            font-weight: bold;
        }
        header nav a.active {
            color: white;
            background-color: #007bff;
            padding: 5px 10px;
            border-radius: 5px;
        }
        main {
            text-align: center;
            padding: 50px 20px;
            background-color: #f5d5d2;
        }
        main .icon-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
        }
        main .icon-container i {
            font-size: 60px;
            color: #007bff;
        }
        main button {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        footer {
            background-color: #d3d3d3;
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }
        footer a {
            color: black;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="/IMG/logo.png" alt="TimePulse Logo">
            <h1>TimePulse</h1>
        </div>
        <nav>
            <a href="#" class="active">Home</a>
            <a href="#">Dashboard</a>
            <a href="#">Profile</a>
            <a href="#">Settings</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <div style="text-align:center; padding: 15%;">
            <p style="font-size: 50px; font-weight:bold;">
                Hello 
                <?php 
                if (isset($_SESSION["email"])) {
                    $email = $_SESSION["email"];
                    
                    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email'");

                    if ($query) {
                        $row = mysqli_fetch_assoc($query);
                        if ($row) {
                            echo $row['firstName'] . ' ' . $row['lastName'];
                        } else {
                            echo "Guest";
                        }
                    } else {
                        echo "Error fetching user data.";
                    }
                } else {
                    echo "Guest";
                }
                ?>
                !
            </p>
            <button>GET STARTED</button>
            <div class="icon-container">
                <i class="fas fa-search"></i>
                <i class="fas fa-stopwatch"></i>
                <i class="fas fa-tasks"></i>
            </div>
        </div>
    </main>

    <footer>
        <a href="#">Terms of Service</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Help</a>
        <a href="#">Contact</a>
        <a href="#">About</a>
    </footer>
</body>
</html>
