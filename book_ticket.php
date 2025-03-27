<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket</title>
    <style>
        body { background-color: #e8f5e9; font-family: Arial, sans-serif; text-align: center; }
        h2 { color: green; }
        .container { width: 50%; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 2px 2px 10px gray; }
        select, input { width: 80%; padding: 10px; margin: 10px; border-radius: 5px; }
        button { background: green; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; }
        button:hover { background: darkgreen; }
    </style>
</head>
<body>

<div class="container">
    <h2>Book Your Ticket</h2>
    <form method="POST" action="payment.php">
        <label> Name: </label><br>
        <input type="text" name="name" required><br>

        <label> Phone: </label><br>
        <input type="text" name="phone" required><br>

        <label> Email ID: </label><br>
        <input type="email" name="email" required><br>

        <label> Source: </label><br>
        <select name="source" id="source" onchange="calculateFare()" required>
            <option value="">Select Source</option>
            <option value="Velachery">Velachery</option>
            <option value="Koyambedu">Koyambedu</option>
            <option value="Tambaram">Tambaram</option>
            <option value="Porur">Porur</option>
            <option value="Annanagar">Annanagar</option>
            <option value="Poonamallee">Poonamallee</option>
            <option value="Maduravoyal">Maduravoyal</option>
            <option value="T Nagar">T Nagar</option>
            <option value="Redhills">Redhills</option>
        </select><br>

        <label> Destination: </label><br>
        <select name="destination" id="destination" onchange="calculateFare()" required>
            <option value="">Select Destination</option>
            <option value="Velachery">Velachery</option>
            <option value="Koyambedu">Koyambedu</option>
            <option value="Tambaram">Tambaram</option>
            <option value="Porur">Porur</option>
            <option value="Annanagar">Annanagar</option>
            <option value="Poonamallee">Poonamallee</option>
            <option value="Maduravoyal">Maduravoyal</option>
            <option value="T Nagar">T Nagar</option>
            <option value="Redhills">Redhills</option>
        </select><br>

        <label> Amount: </label><br>
        <input type="text" name="amount" id="amount" readonly placeholder="₹ 0"><br>

        <button type="submit" name="book">Proceed to Payment</button>
    </form>
</div>

<script>
function calculateFare() {
    let source = document.getElementById("source").value;
    let destination = document.getElementById("destination").value;
    
    let fares = {
        "Velachery": {"Koyambedu": 35, "Tambaram": 26, "Porur": 32, "Annanagar": 44, "Poonamallee": 48, "Maduravoyal": 40, "T Nagar": 30, "Redhills": 60},
        "Koyambedu": {"Velachery": 35, "Tambaram": 28, "Porur": 24, "Annanagar": 20, "Poonamallee": 30, "Maduravoyal": 15, "T Nagar": 32, "Redhills": 44},
        "Tambaram": {"Velachery": 26, "Koyambedu": 28, "Porur": 28, "Annanagar": 36, "Poonamallee": 44, "Maduravoyal": 40, "T Nagar": 34, "Redhills": 56},
        "Porur": {"Velachery": 32, "Koyambedu": 24, "Tambaram": 28, "Annanagar": 24, "Poonamallee": 20, "Maduravoyal": 22, "T Nagar": 26, "Redhills": 40},
        "Annanagar": {"Velachery": 44, "Koyambedu": 20, "Tambaram": 36, "Porur": 24, "Poonamallee": 28, "Maduravoyal": 24, "T Nagar": 20, "Redhills": 50},
        "Poonamallee": {"Velachery": 48, "Koyambedu": 30, "Tambaram": 44, "Porur": 20, "Annanagar": 28, "Maduravoyal": 20, "T Nagar": 36, "Redhills": 56},
        "Maduravoyal": {"Velachery": 40, "Koyambedu": 15, "Tambaram": 40, "Porur": 22, "Annanagar": 24, "Poonamallee": 20, "T Nagar": 25, "Redhills": 30},
        "T Nagar": {"Velachery": 30, "Koyambedu": 32, "Tambaram": 34, "Porur": 26, "Annanagar": 20, "Poonamallee": 36, "Maduravoyal": 25, "Redhills": 48},
        "Redhills": {"Velachery": 60, "Koyambedu": 44, "Tambaram": 56, "Porur": 40, "Annanagar": 50, "Poonamallee": 56, "Maduravoyal": 30, "T Nagar": 48}
    };

    if (source === destination) {
        document.getElementById("amount").value = "₹ 0";
    } else if (fares[source] && fares[source][destination]) {
        document.getElementById("amount").value = "₹ " + fares[source][destination];
    } else if (fares[destination] && fares[destination][source]) {
        document.getElementById("amount").value = "₹ " + fares[destination][source];
    } else {
        document.getElementById("amount").value = "N/A";
    }
}
</script>

</body>
</html>
