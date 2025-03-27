<?php
session_start();
include 'db.php'; // Using provided database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Bus Ticketing - Home</title>
    <style>
        body {
            background-color: #e8f5e9; /* Light Green Background */
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            width: 50%;
            margin: auto;
            margin-top: 100px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #4CAF50;
        }
        h1 {
            color: #388E3C;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 18px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #2E7D32;
        }
        .links {
            margin-top: 20px;
        }
        .links a {
            text-decoration: none;
            color: #388E3C;
            font-size: 16px;
        }
        .bus-image {
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 5px gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Smart Bus Ticketing System</h1>
        <p>Book your tickets quickly and easily!</p>
        <img src="C:\xamppp\htdocs\busticket\busimage\360_F_269475198_k41qahrZ1j4RK1sarncMiFHpcmE2qllQ.jpg" alt="Bus Image" class="bus-image">
        <div class="links">
            <p><a href="login.php" class="btn">Login</a> <a href="register.php" class="btn">Register</a> </p>
        </div>
    </div>
</body>
</html>
