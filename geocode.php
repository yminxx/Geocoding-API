<?php
function getGeocodeData($location)
{
    $apiUrl = "https://geocoding-api.open-meteo.com/v1/search?name=" . urlencode($location) . "&count=20&language=en&format=json";
    $response = file_get_contents($apiUrl);

    if ($response !== false) {
        $data = json_decode($response, true);
        return [
            "results" => $data["results"] ?? [],
            "error" => null
        ];
    } else {
        return [
            "results" => [],
            "error" => "Could not fetch geocode data for the location provided."
        ];
    }
}

$location = $_GET['location'] ?? 'Philippines';
$geocodeData = getGeocodeData($location);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geocoding API - Location Data</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Geocoding Data for <?php echo htmlspecialchars($location); ?></h1>
        <h4>View detailed geocoding information</h4>
        <div class="nav">
            <a href="index.php">Home</a>
            <a href="geocode.php">View Current Location Data</a>
            <a href="info.php">About the API</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Country Flag</th>
                    <th>Name</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Elevation</th>
                    <th>Population</th>
                    <th>Feature Code</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($geocodeData["results"])): ?>
                    <?php foreach ($geocodeData["results"] as $result): ?>
                        <tr>
                            <td><img class="flag-img"
                                    src="https://open-meteo.com/images/country-flags/<?php echo strtolower($result['country_code']); ?>.svg"
                                    alt="Flag"></td>
                            <td><?php echo htmlspecialchars($result["name"]); ?></td>
                            <td><?php echo htmlspecialchars($result["longitude"]); ?></td>
                            <td><?php echo htmlspecialchars($result["latitude"]); ?></td>
                            <td><?php echo htmlspecialchars($result["elevation"]); ?></td>
                            <td><?php $population = $result["population"] ?? 0;
                            echo ($population > 0) ? htmlspecialchars($population) : 'Population data not available';
                            ?>
                            </td>
                            <td><?php echo htmlspecialchars($result["feature_code"]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6"><?php echo htmlspecialchars($geocodeData["error"] ?? "No results found."); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>