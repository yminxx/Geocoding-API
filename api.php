<?php
function getGeocodeData($location) {
    $apiUrl = "https://geocoding-api.open-meteo.com/v1/search?name=" . urlencode($location) . "&count=20&language=en&format=json";
    $response = file_get_contents($apiUrl);
    
    if ($response !== false) {
        return json_decode($response, true);
    }
    return null;
}
?>
