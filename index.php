<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Reservation</title>
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
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the QR-Based Bus Ticket Reservation System</h1>
        <p>Book your tickets quickly and easily!</p>
        <a href="book_ticket.php" class="btn">Book Ticket</a>

        <div class="links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <p><a href="logout.php">Logout</a></p>
            <?php else: ?>
                <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
