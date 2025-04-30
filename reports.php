<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include 'includes/db_connect.php';

// Get user ID
$user_id = $_SESSION['user_id'];

// Get user reports
$reports_query = "SELECT r.id, r.created_at, reg.name as region_name, c.name as crop_name, 
                 w.name as waste_name, r.waste_amount, r.farm_size 
                 FROM reports r 
                 JOIN regions reg ON r.region_id = reg.id 
                 JOIN crops c ON r.crop_type_id = c.id 
                 JOIN waste_types w ON r.waste_type_id = w.id 
                 WHERE r.user_id = ? 
                 ORDER BY r.created_at DESC";

$stmt = $conn->prepare($reports_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$reports_result = $stmt->get_result();

$reports = [];
if ($reports_result->num_rows > 0) {
    while($row = $reports_result->fetch_assoc()) {
        $reports[] = $row;
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
    <title>My Reports - AgriSmart Planner</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <section class="page-header">
            <div class="container">
                <h1>My Reports</h1>
                <p>View and download your saved waste management reports</p>
            </div>
        </section>
        
        <section class="reports-section">
            <div class="container">
                <?php if(count($reports) > 0): ?>
                    <div class="reports-table-container">
                        <table class="reports-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Region</th>
                                    <th>Crop</th>
                                    <th>Waste Type</th>
                                    <th>Total Waste</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reports as $report): ?>
                                    <tr>
                                        <td><?php echo date('M d, Y', strtotime($report['created_at'])); ?></td>
                                        <td><?php echo htmlspecialchars($report['region_name']); ?></td>
                                        <td><?php echo htmlspecialchars($report['crop_name']); ?></td>
                                        <td><?php echo htmlspecialchars($report['waste_name']); ?></td>
                                        <td><?php echo number_format($report['waste_amount'] * $report['farm_size'], 2); ?> tons</td>
                                        <td class="actions">
                                            <a href="results.php?report_id=<?php echo $report['id']; ?>" class="btn-view">View</a>
                                            <a href="download-pdf.php?report_id=<?php echo $report['id']; ?>" class="btn-download">Download</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-reports">
                        <div class="empty-icon">
                            <img src="assets/images/icons/empty-reports.png" alt="No reports">
                        </div>
                        <h2>No Reports Found</h2>
                        <p>You haven't created any waste management reports yet.</p>
                        <a href="region-selector.php" class="btn btn-primary">Create Your First Report</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>