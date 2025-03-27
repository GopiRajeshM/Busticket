<?php
session_start();

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store booking details in session
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['source'] = $_POST['source'];
    $_SESSION['destination'] = $_POST['destination'];
    $_SESSION['amount'] = $_POST['amount'];
} else {
    die("No booking details found. Please complete the booking.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        body { background-color: #e8f5e9; font-family: Arial, sans-serif; text-align: center; }
        .container { width: 50%; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 2px 2px 10px gray; }
        h2 { color: green; }
        input { width: 80%; padding: 10px; margin: 10px; border-radius: 5px; border: 1px solid gray; }
        button { background: green; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; }
        button:hover { background: darkgreen; }
        .card-images img { width: 50px; margin: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Summary</h2>
        <p><strong>Name:</strong> <?php echo $_SESSION['name']; ?></p>
        <p><strong>Phone:</strong> <?php echo $_SESSION['phone']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        <p><strong>From:</strong> <?php echo $_SESSION['source']; ?> → <strong>To:</strong> <?php echo $_SESSION['destination']; ?></p>
        <p><strong>Amount:</strong> <?php echo $_SESSION['amount']; ?></p>

        <h2>Secure Payment</h2>
        <div class="card-images">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="MasterCard">
        </div>
        
        <form action="process_payment.php" method="POST">
            <input type="hidden" name="session_id" value="<?php echo session_id(); ?>">
            
            <label>Card Number:</label><br>
            <input type="text" name="card_number" pattern="\d{16}" maxlength="16" required placeholder="Enter 16-digit card number"><br>
            
            <label>Name on Card:</label><br>
            <input type="text" name="card_name" required placeholder="Enter name on card"><br>
            
            <label>CVV:</label><br>
            <input type="text" name="cvv" pattern="\d{3}" maxlength="3" required placeholder="3-digit CVV"><br>
            
            <label>Expiry Date:</label><br>
            <input type="text" name="expiry_date" pattern="(0[1-9]|1[0-2])/(\d{4})" required placeholder="MM/YYYY"><br>
            
            <button type="submit">Pay Now</button>
        </form>
    </div>
</body>
</html>
