<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($new_password == $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $query = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
        if (mysqli_query($conn, $query)) {
            echo "<p style='color: green;'>Password updated successfully! <a href='login.php'>Login here</a></p>";
        } else {
            echo "<p style='color: red;'>Error updating password.</p>";
        }
    } else {
        echo "<p style='color: red;'>Passwords do not match.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 30%;
            margin: auto;
            background: white;
            padding: 20px;
            margin-top: 100px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }
        input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            background: green;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn:hover {
            background: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Enter Email" required><br>
            <input type="password" name="new_password" placeholder="Enter New Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required><br>
            <button type="submit" class="btn">Reset Password</button>
        </form>
        <p>Back to <a href="login.php">Login</a></p>
    </div>
</body>
</html>
