<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if form was submitted
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: waste-optimizer.php");
    exit();
}

// Database connection
include 'includes/db_connect.php';
include 'includes/functions.php';

// Get form data
$region_id = $_POST['region_id'];
$crop_type = $_POST['crop_type'];
$waste_type = $_POST['waste_type'];
$waste_amount = $_POST['waste_amount'];
$farm_size = $_POST['farm_size'];
$space_available = $_POST['space_available'];
$solar_panels = $_POST['solar_panels'];
$solar_capacity = isset($_POST['solar_capacity']) ? $_POST['solar_capacity'] : 0;
$budget = $_POST['budget'];
$current_practice = $_POST['current_practice'];
$notes = isset($_POST['notes']) ? $_POST['notes'] : '';

// Get region data
$region_query = "SELECT * FROM regions WHERE id = ?";
$stmt = $conn->prepare($region_query);
$stmt->bind_param("i", $region_id);
$stmt->execute();
$region_result = $stmt->get_result();
$region = $region_result->fetch_assoc();

// Get crop data
$crop_query = "SELECT * FROM crops WHERE id = ?";
$stmt = $conn->prepare($crop_query);
$stmt->bind_param("i", $crop_type);
$stmt->execute();
$crop_result = $stmt->get_result();
$crop = $crop_result->fetch_assoc();

// Get waste data
$waste_query = "SELECT * FROM waste_types WHERE id = ?";
$stmt = $conn->prepare($waste_query);
$stmt->bind_param("i", $waste_type);
$stmt->execute();
$waste_result = $stmt->get_result();
$waste = $waste_result->fetch_assoc();

// Calculate total waste
$total_waste = $waste_amount * $farm_size;

// Generate recommendations based on inputs
// This would typically involve complex logic based on the region, crop, waste type, etc.
// For this example, we'll use simplified logic

// Get disposal methods
$disposal_methods = getDisposalMethods($conn, $region_id, $waste_type, $space_available);

// Get solar devices
$solar_devices = getSolarDevices($conn, $region_id, $budget, $solar_panels);

// Get product options
$product_options = getProductOptions($conn, $waste_type, $budget);

// Calculate estimated income
$estimated_income = calculateEstimatedIncome($waste_type, $total_waste);

// Save results to database
$user_id = $_SESSION['user_id'];
$report_id = saveReport($conn, $user_id, $region_id, $crop_type, $waste_type, $waste_amount, $farm_size, $space_available, $solar_panels, $solar_capacity, $budget, $current_practice, $notes);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - AgriSmart Planner</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <section class="page-header">
            <div class="container">
                <h1>Your AgriSmart Results</h1>
                <p>Personalized recommendations for optimizing your agricultural waste</p>
            </div>
        </section>
        
        <section class="results-section">
            <div class="container">
                <div class="results-summary">
                    <div class="summary-card">
                        <h3>Input Summary</h3>
                        <div class="summary-details">
                            <div class="summary-item">
                                <span class="label">Region:</span>
                                <span class="value"><?php echo htmlspecialchars($region['name']); ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Crop Type:</span>
                                <span class="value"><?php echo htmlspecialchars($crop['name']); ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Waste Type:</span>
                                <span class="value"><?php echo htmlspecialchars($waste['name']); ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Total Waste:</span>
                                <span class="value"><?php echo number_format($total_waste, 2); ?> tons</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="summary-card">
                        <h3>Solar Suitability Score</h3>
                        <div class="solar-score">
                            <div class="score-value"><?php echo calculateSolarScore($region['solar_potential'], $space_available); ?>/10</div>
                            <div class="score-label"><?php echo getSolarScoreLabel($region['solar_potential']); ?></div>
                        </div>
                        <p class="score-description"><?php echo getSolarScoreDescription($region['solar_potential']); ?></p>
                    </div>
                </div>
                
                <div class="results-cards">
                    <div class="result-card">
                        <div class="card-icon">
                            <img src="assets/images/icons/disposable.jpg" alt="Disposal Method Icon">
                        </div>
                        <h3>Best Residue Management Method</h3>
                        <ul class="recommendation-list">
                            <?php foreach($disposal_methods as $method): ?>
                                <li>
                                    <h4><?php echo htmlspecialchars($method['name']); ?></h4>
                                    <p><?php echo htmlspecialchars($method['description']); ?></p>
                                    <div class="suitability">
                                        <span class="label">Suitability:</span>
                                        <div class="suitability-bar">
                                            <div class="suitability-fill" style="width: <?php echo $method['suitability']; ?>%"></div>
                                        </div>
                                        <span class="suitability-value"><?php echo $method['suitability']; ?>%</span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="learn.php#disposal-methods" class="learn-more">Learn more about disposal methods</a>
                    </div>
                    
                    <div class="result-card">
                        <div class="card-icon">
                            <img src="assets/images/icons/solar-device.jpg" alt="Solar Device Icon">
                        </div>
                        <h3>Recommended Solar-Powered Tech</h3>
                        <ul class="recommendation-list">
                            <?php foreach($solar_devices as $device): ?>
                                <li>
                                    <h4><?php echo htmlspecialchars($device['name']); ?></h4>
                                    <p><?php echo htmlspecialchars($device['description']); ?></p>
                                    <div class="device-details">
                                        <div class="detail-item">
                                            <span class="label">Estimated Cost:</span>
                                            <span class="value">₹<?php echo number_format($device['cost']); ?></span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="label">ROI Period:</span>
                                            <span class="value"><?php echo $device['roi_period']; ?> years</span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="learn.php#solar-tech" class="learn-more">Learn more about solar technologies</a>
                    </div>
                    
                    <div class="result-card">
                        <div class="card-icon">
                            <img src="assets/images/icons/product.jpg" alt="Product Icon">
                        </div>
                        <h3>Product Ideas from Your Waste</h3>
                        <ul class="recommendation-list">
                            <?php foreach($product_options as $product): ?>
                                <li>
                                    <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                                    <div class="product-details">
                                        <div class="detail-item">
                                            <span class="label">Processing Complexity:</span>
                                            <span class="value"><?php echo $product['complexity']; ?></span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="label">Market Demand:</span>
                                            <span class="value"><?php echo $product['market_demand']; ?></span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="learn.php#waste-products" class="learn-more">Learn more about waste products</a>
                    </div>
                    
                    <div class="result-card income-card">
                        <div class="card-icon">
                            <img src="assets/images/icons/profit.jpg" alt="Profit Icon">
                        </div>
                        <h3>Estimated Profit Potential</h3>
                        <div class="income-details">
                            <div class="income-item">
                                <h4>Estimated Income per Ton:</h4>
                                <div class="income-value">₹<?php echo number_format($estimated_income['per_ton']); ?></div>
                            </div>
                            <div class="income-item">
                                <h4>Total Potential Income:</h4>
                                <div class="income-value total">₹<?php echo number_format($estimated_income['total']); ?></div>
                                <p class="income-note">Based on your total waste of <?php echo number_format($total_waste, 2); ?> tons</p>
                            </div>
                        </div>
                        <div class="income-disclaimer">
                            <p>Note: Actual income may vary based on market conditions, processing efficiency, and other factors.</p>
                        </div>
                    </div>
                </div>
                
                <div class="results-actions">
                    <a href="download-pdf.php?report_id=<?php echo $report_id; ?>" class="btn btn-primary">Download PDF Report</a>
                    <a href="waste-optimizer.php?region=<?php echo $region_id; ?>" class="btn btn-secondary">Modify Inputs</a>
                    <a href="dashboard.php" class="btn btn-outline">Back to Dashboard</a>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>