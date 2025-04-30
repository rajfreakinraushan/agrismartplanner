<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if region is selected
if (!isset($_GET['region']) || empty($_GET['region'])) {
    header("Location: region-selector.php");
    exit();
}

$region_id = $_GET['region'];

// Database connection
include 'includes/db_connect.php';

// Get region data
$region_query = "SELECT * FROM regions WHERE id = ?";
$stmt = $conn->prepare($region_query);
$stmt->bind_param("i", $region_id);
$stmt->execute();
$region_result = $stmt->get_result();

if ($region_result->num_rows == 0) {
    header("Location: region-selector.php");
    exit();
}

$region = $region_result->fetch_assoc();

// Get crop types
// Get crop types for the region
$crops_query = "SELECT * FROM crops ORDER BY name";
$stmt = $conn->prepare($crops_query);
$stmt->execute();
$crops_result = $stmt->get_result();
$crops = [];

if ($crops_result->num_rows > 0) {
    while($row = $crops_result->fetch_assoc()) {
        $crops[] = $row;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Optimizer - AgriSmart Planner</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <section class="page-header">
            <div class="container">
                <h1>Waste Optimizer</h1>
                <p>Enter your crop and waste details to get personalized recommendations</p>
            </div>
        </section>
        
        <section class="optimizer-form">
            <div class="container">
                <div class="form-container">
                    <div class="selected-region">
                        <h3>Selected Region: <?php echo htmlspecialchars($region['name']); ?></h3>
                        <p><strong>Solar Potential:</strong> <?php echo htmlspecialchars($region['solar_potential']); ?></p>
                        <a href="region-selector.php" class="change-region">Change Region</a>
                    </div>
                    
                    <form action="results.php" method="post" id="optimizer-form">
                        <input type="hidden" name="region_id" value="<?php echo $region_id; ?>">
                        
                        <div class="form-section">
                            <h3>Crop Information</h3>
                            
                            <div class="form-group">
                                <label for="crop_type">Crop Type</label>
                                <select id="crop_type" name="crop_type" required>
                                    <option value="">-- Select Crop Type --</option>
                                    <?php foreach($crops as $crop): ?>
                                        <option value="<?php echo $crop['id']; ?>"><?php echo htmlspecialchars($crop['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="waste_type">Waste Type</label>
                                <select id="waste_type" name="waste_type" required disabled>
                                    <option value="">-- Select Crop Type First --</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="waste_amount">Waste Amount (tons/acre)</label>
                                <input type="number" id="waste_amount" name="waste_amount" min="0.1" step="0.1" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="farm_size">Farm Size (acres)</label>
                                <input type="number" id="farm_size" name="farm_size" min="0.1" step="0.1" required>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Resources Available</h3>
                            
                            <div class="form-group">
                                <label for="space_available">Space Available for Processing</label>
                                <select id="space_available" name="space_available" required>
                                    <option value  name="space_available" required>
                                    <option value="">-- Select Option --</option>
                                    <option value="none">None</option>
                                    <option value="small">Small (Less than 1 acre)</option>
                                    <option value="medium">Medium (1-5 acres)</option>
                                    <option value="large">Large (More than 5 acres)</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Do you have solar panels installed?</label>
                                <div class="radio-group">
                                    <input type="radio" id="solar_yes" name="solar_panels" value="yes">
                                    <label for="solar_yes">Yes</label>
                                    
                                    <input type="radio" id="solar_no" name="solar_panels" value="no" checked>
                                    <label for="solar_no">No</label>
                                </div>
                            </div>
                            
                            <div class="form-group" id="solar_capacity_group" style="display: none;">
                                <label for="solar_capacity">Solar Capacity (kW)</label>
                                <input type="number" id="solar_capacity" name="solar_capacity" min="0.1" step="0.1">
                            </div>
                            
                            <div class="form-group">
                                <label for="budget">Available Budget for Investment (₹)</label>
                                <select id="budget" name="budget" required>
                                    <option value="">-- Select Option --</option>
                                    <option value="low">Low (Less than ₹50,000)</option>
                                    <option value="medium">Medium (₹50,000 - ₹2,00,000)</option>
                                    <option value="high">High (More than ₹2,00,000)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Additional Information</h3>
                            
                            <div class="form-group">
                                <label for="current_practice">Current Waste Management Practice</label>
                                <select id="current_practice" name="current_practice" required>
                                    <option value="">-- Select Option --</option>
                                    <option value="burning">Burning</option>
                                    <option value="plowing">Plowing back into soil</option>
                                    <option value="composting">Composting</option>
                                    <option value="selling">Selling as is</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="notes">Additional Notes (Optional)</label>
                                <textarea id="notes" name="notes" rows="4"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Get Recommendations</button>
                            <button type="reset" class="btn btn-secondary">Reset Form</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form.js"></script>
</body>
</html>