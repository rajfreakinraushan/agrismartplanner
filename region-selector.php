<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include 'includes/db_connect.php';

// Get regions data - This is where we need to add more regions
$regions = [
    ['id' => 1, 'name' => 'Punjab', 'solar_potential' => 'High'],
    ['id' => 2, 'name' => 'Maharashtra', 'solar_potential' => 'Very High'],
    ['id' => 3, 'name' => 'Karnataka', 'solar_potential' => 'High'],
    ['id' => 4, 'name' => 'Gujarat', 'solar_potential' => 'Very High'],
    ['id' => 5, 'name' => 'Uttar Pradesh', 'solar_potential' => 'Medium'],
    ['id' => 6, 'name' => 'Haryana', 'solar_potential' => 'High'],
    ['id' => 7, 'name' => 'Rajasthan', 'solar_potential' => 'Very High'],
    ['id' => 8, 'name' => 'Madhya Pradesh', 'solar_potential' => 'High'],
    ['id' => 9, 'name' => 'Tamil Nadu', 'solar_potential' => 'Very High'],
    ['id' => 10, 'name' => 'Andhra Pradesh', 'solar_potential' => 'High']
];

// In a real application, this would be fetched from the database:
// $regions_query = "SELECT * FROM regions ORDER BY name";
// $regions_result = $conn->query($regions_query);
// $regions = [];
// if ($regions_result->num_rows > 0) {
//     while($row = $regions_result->fetch_assoc()) {
//         $regions[] = $row;
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Region - AgriSmart Planner</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <section class="page-header">
            <div class="container">
                <h1>Select Your Region</h1>
                <p>Choose your location to get region-specific solar potential and waste management options</p>
            </div>
        </section>
        
        <section class="region-selector">
            <div class="container">
                <div class="region-map-container">
                    <div class="region-map">
                        <img src="assets/images/india-map.png" alt="Map of India" id="india-map" usemap="#india-map">
                        <map name="india-map" id="india-map-areas">
                            <!-- Map areas will be populated by JavaScript -->
                        </map>
                    </div>
                    
                    <div class="region-dropdown">
                        <h3>Or select from dropdown</h3>
                        <form action="waste-optimizer.php" method="get" id="region-form">
                            <div class="form-group">
                                <label for="region">Select Region</label>
                                <select id="region" name="region" required>
                                    <option value="">-- Select Region --</option>
                                    <?php foreach($regions as $region): ?>
                                        <option value="<?php echo $region['id']; ?>"><?php echo htmlspecialchars($region['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </form>
                    </div>
                </div>
                
                <div class="region-info" id="region-info">
                    <h3>Region Information</h3>
                    <p>Select a region to view solar potential and common agricultural waste in that area.</p>
                    <div class="region-details" id="region-details" style="display: none;">
                        <div class="detail-item">
                            <h4>Region:</h4>
                            <p id="selected-region-name">-</p>
                        </div>
                        <div class="detail-item">
                            <h4>Solar Potential:</h4>
                            <p id="solar-potential">-</p>
                        </div>
                        <div class="detail-item">
                            <h4>Common Agricultural Waste:</h4>
                            <ul id="common-waste">
                                <li>-</li>
                            </ul>
                        </div>
                        <button id="continue-btn" class="btn btn-primary">Continue with this Region</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/map.js"></script>
</body>
</html>