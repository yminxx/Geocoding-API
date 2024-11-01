<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geocoding API - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Geocoding Data</h1>
        <h4>Search locations globally</h4>
        <div class="nav">
            <a href="index.php">Home</a>
            <a href="geocode.php">View Current Location Data</a>
            <a href="info.php">About the API</a>
        </div>
        <div class="form-container">
            <form action="geocode.php" method="GET">
                <div style="text-align: center;"> 
                    <label for="location">Enter Location:</label>
                    <input type="text" id="location" name="location" required>
                    <input type="submit" value="Get Data">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
