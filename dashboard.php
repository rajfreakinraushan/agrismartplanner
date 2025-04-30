<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user information
$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AgriSmart Planner</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <section class="dashboard-header">
            <div class="container">
                <h1>Welcome, <?php echo htmlspecialchars($user_name); ?></h1>
                <p>Let's optimize your agricultural waste management</p>
            </div>
        </section>
        
        <section class="dashboard-content">
            <div class="container">
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <h3>Start New Assessment</h3>
                        <p>Create a new waste management plan for your farm</p>
                        <a href="region-selector.php" class="btn btn-primary">Launch AgriSmart Planner</a>
                    </div>
                    
                    <div class="dashboard-card">
                        <h3>Previous Reports</h3>
                        <p>View and download your saved waste management reports</p>
                        <a href="reports.php" class="btn btn-secondary">View Reports</a>
                    </div>
                    
                    <div class="dashboard-card">
                        <h3>Learn More</h3>
                        <p>Explore our educational resources on waste management</p>
                        <a href="learn.php" class="btn btn-secondary">Go to Learn</a>
                    </div>
                </div>
                
                <div class="recent-activity">
                    <h2>Recent Activity</h2>
                    <div class="activity-list">
                        <p class="empty-state">No recent activity. Start by creating a new assessment!</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>