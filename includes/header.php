<header class="site-header">
    <div class="container">
        <div class="logo">
            <a href="index.php">
                <img src="assets/images/logo.png" alt="AgriSmart Planner Logo">
                <span>AgriSmart Planner</span>
            </a>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="learn.php">Learn</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php" class="btn btn-outline">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="btn btn-outline">Login</a></li>
                    <li><a href="register.php" class="btn btn-primary">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <button class="mobile-menu-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>