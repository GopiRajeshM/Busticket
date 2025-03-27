<?php
$servername = "localhost"; // Your database server (Keep as 'localhost' for XAMPP)
$username = "root"; // Default username in XAMPP
$password = ""; // Default password is empty
$database = "bus_ticket_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
