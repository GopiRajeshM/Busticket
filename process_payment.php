<?php
session_start();
include 'db.php'; // Include database connection
include 'phpqrcode/qrlib.php'; // Include QR Code library

// Check if payment details are submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card_number = $_POST['card_number'];
    $card_name = $_POST['card_name'];
    $cvv = $_POST['cvv'];
    $expiry_date = $_POST['expiry_date'];

    // Basic validation
    if (!preg_match('/^\d{16}$/', $card_number) || !preg_match('/^\d{3}$/', $cvv) || !preg_match('/^(0[1-9]|1[0-2])\/(\d{4})$/', $expiry_date)) {
        die("Invalid payment details. Please go back and enter correct details.");
    }

    // Generate a random transaction ID
    $transaction_id = "TXN" . rand(100000, 999999);
    $_SESSION['transaction_id'] = $transaction_id;

    // Store booking details in database
    $name = $_SESSION['name'];
    $phone = $_SESSION['phone'];
    $email = $_SESSION['email'];
    $source = $_SESSION['source'];
    $destination = $_SESSION['destination'];
    $amount = $_SESSION['amount'];

    $query = "INSERT INTO bookings (name, phone, email, source, destination, amount, transaction_id) 
              VALUES ('$name', '$phone', '$email', '$source', '$destination', '$amount', '$transaction_id')";
    mysqli_query($conn, $query);

    // Generate QR data
    $qr_data = "Name: " . $name . "\nPhone: " . $phone . "\nEmail: " . $email .
        "\nFrom: " . $source . " → To: " . $destination . "\nAmount: ₹" . $amount .
        "\nTransaction ID: " . $transaction_id;

    // Generate QR code
    $qr_file = "qrcodes/" . $transaction_id . ".png";
    QRcode::png($qr_data, $qr_file, QR_ECLEVEL_L, 5);

    // Store payment success message in session
    $_SESSION['payment_success'] = true;
    $_SESSION['qr_file'] = $qr_file;
} else {
    header("Location: payment.php"); // Redirect to payment page if accessed directly
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body { background-color: #e8f5e9; font-family: Arial, sans-serif; text-align: center; }
        .container { width: 50%; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 2px 2px 10px gray; margin-top: 50px; }
        h2 { color: green; }
        .success-message { font-size: 20px; color: green; margin-top: 20px; }
        .transaction-id { font-size: 18px; font-weight: bold; margin-top: 10px; }
        .qr-code img { width: 200px; margin-top: 20px; }
        .button { background: green; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; margin-top: 20px; text-decoration: none; display: inline-block; }
        .button:hover { background: darkgreen; }
    </style>
</head>
<body>
    <div class="container">
        <h2>✅ Payment Successful!</h2>
        <p class="success-message">Thank you for your payment.</p>
        <p class="transaction-id">Transaction ID: <b><?php echo $_SESSION['transaction_id']; ?></b></p>
        <p class="transaction-id">Amount Paid: <b><?php echo $_SESSION['amount']; ?></b></p>
        <div class="qr-code">
            <img src="<?php echo $_SESSION['qr_file']; ?>" alt="QR Code">
        </div>
        <a href="generate_qr.php?txn=<?php echo $_SESSION['transaction_id']; ?>" class="button">🎟 View Full Ticket</a>
    </div>
</body>
</html>