<?php
include 'db.php'; // Database connection

if(isset($_POST['source']) && isset($_POST['destination'])) {
    $source = urlencode($_POST['source']);
    $destination = urlencode($_POST['destination']);
    
    if ($source == $destination) {
        echo "0"; // If same source & destination, fare is ₹0
        exit;
    }

    // Google Maps API Key (Replace with your key)
    $apiKey = "YOUR_GOOGLE_MAPS_API_KEY";

    // API URL to get distance
    $apiUrl = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$source&destinations=$destination&key=$apiKey";

    // Call API
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    if($data['status'] == "OK") {
        // Get distance in meters
        $distance = $data['rows'][0]['elements'][0]['distance']['value']; 
        $distanceKm = $distance / 1000; // Convert to KM

        // Calculate fare (₹2 per KM)
        $fare = round($distanceKm * 2, 2);

        echo $fare; // Return fare
    } else {
        echo "0"; // Default if API fails
    }
}
?>
