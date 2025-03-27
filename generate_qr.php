<?php
session_start();
include 'db.php'; // Include database connection
include 'phpqrcode/qrlib.php'; // Include QR Code library

// Check if transaction ID is provided via GET or SESSION
if (isset($_GET['txn'])) {
    $transaction_id = mysqli_real_escape_string($conn, $_GET['txn']);
} elseif (isset($_SESSION['transaction_id'])) {
    $transaction_id = mysqli_real_escape_string($conn, $_SESSION['transaction_id']);
} else {
    die("Transaction ID is missing.");
}

// Fetch booking details from the database
$query = "SELECT * FROM bookings WHERE transaction_id = '$transaction_id'";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Check if transaction exists
if (mysqli_num_rows($result) == 0) {
    die("Invalid transaction ID. Please check and try again.");
}

$booking = mysqli_fetch_assoc($result);

// Generate QR data
$qr_data = "Name: " . htmlspecialchars($booking['name']) . 
           "\nPhone: " . htmlspecialchars($booking['phone']) . 
           "\nEmail: " . htmlspecialchars($booking['email']) . 
           "\nFrom: " . htmlspecialchars($booking['source']) . " → To: " . htmlspecialchars($booking['destination']) . 
           "\nAmount: ₹" . htmlspecialchars($booking['amount']) . 
           "\nTransaction ID: " . htmlspecialchars($booking['transaction_id']);

// Create the QR codes directory if it doesn't exist
$qr_dir = "qrcodes/";
if (!file_exists($qr_dir)) {
    mkdir($qr_dir, 0777, true);
}

// Generate QR code
$qr_file = $qr_dir . $transaction_id . ".png";
QRcode::png($qr_data, $qr_file, QR_ECLEVEL_L, 5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket QR Code</title>
    <style>
        body {
            background-color: #e8f5e9;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 50%;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px gray;
            text-align: center;
        }
        h2 {
            color: green;
            font-size: 28px;
            margin-bottom: 20px;
        }
        .ticket-details {
            font-size: 20px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .ticket-details p {
            margin: 8px 0;
        }
        .ticket-details p strong {
            font-weight: bold;
        }
        .qr-code img {
            width: 250px;
            margin-top: 20px;
        }
        .button {
            background: green;
            color: white;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
        }
        .button:hover {
            background: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🎟 Your Ticket</h2>
        <div class="ticket-details">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($booking['phone']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($booking['email']); ?></p>
            <p><strong>From:</strong> <?php echo htmlspecialchars($booking['source']); ?> → <strong>To:</strong> <?php echo htmlspecialchars($booking['destination']); ?></p>
            <p class="transaction-id">Amount Paid: <b><?php echo $_SESSION['amount']; ?></b></p>
            <p><strong>Transaction ID:</strong> <?php echo htmlspecialchars($booking['transaction_id']); ?></p>
        </div>
        <div class="qr-code">
            <img src="<?php echo $qr_file; ?>" alt="QR Code">
        </div>
        <a href="index.php" class="button">🏠 Home</a>
    </div>
</body>
</html>
