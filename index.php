<?php
session_start();
$loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriSmart Planner - Turn Waste into Wealth</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Turn Your Waste into Wealth Using Smart Green Tech</h1>
                    <p class="tagline">Plan. Optimize. Profit from Your Agri-Waste.</p>
                    <p class="description">AgriSmart Planner helps you find the best ways to manage agricultural waste, harness solar energy, and generate additional income from your farm residues.</p>
                    <?php if($loggedIn): ?>
                        <a href="dashboard.php" class="btn btn-primary">Launch AgriSmart Planner</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary">Get Started</a>
                        <a href="register.php" class="btn btn-secondary">Create Account</a>
                    <?php endif; ?>
                </div>
                <div class="hero-image">
                    <img src="assets/images/hero-image.png" alt="Agricultural waste management illustration">
                </div>
            </div>
        </section>

        <section class="features">
            <div class="container">
                <h2>How AgriSmart Planner Works</h2>
                <div class="feature-cards">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="assets/images/icons/location.jpg" alt="Location icon">
                        </div>
                        <h3>Select Your Region</h3>
                        <p>Choose your location to get region-specific solar potential and waste management options.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="assets/images/icons/crop.jpg" alt="Crop icon">
                        </div>
                        <h3>Input Crop Details</h3>
                        <p>Tell us about your crops and the agricultural waste you generate.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="assets/images/icons/solar.jpg" alt="Solar icon">
                        </div>
                        <h3>Get Solar Solutions</h3>
                        <p>Receive recommendations for solar-powered technologies suited to your needs.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="assets/images/icons/profit.jpg" alt="Profit icon">
                        </div>
                        <h3>Maximize Profits</h3>
                        <p>Discover how to turn your agricultural waste into valuable products and income.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>Ready to optimize your farm waste management?</h2>
                <p>Join thousands of farmers who are already benefiting from AgriSmart Planner.</p>
                <?php if($loggedIn): ?>
                    <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
                <?php else: ?>
                    <a href="register.php" class="btn btn-primary">Sign Up Now</a>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>
