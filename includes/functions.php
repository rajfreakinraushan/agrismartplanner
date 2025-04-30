<?php
// Function to get disposal methods based on region, waste type, and space available
function getDisposalMethods($conn, $region_id, $waste_type, $space_available) {
    // In a real application, this would query the database for suitable disposal methods
    // For this example, we'll return static data
    
    $methods = [];
    
    // Method 1: In-situ incorporation
    $methods[] = [
        'name' => 'In-situ Incorporation',
        'description' => 'Incorporate the waste directly into the soil to improve organic matter content and soil health.',
        'suitability' => 85
    ];
    
    // Method 2: Composting
    $suitability_composting = 70;
    if ($space_available == 'medium' || $space_available == 'large') {
        $suitability_composting = 90;
    }
    
    $methods[] = [
        'name' => 'Composting',
        'description' => 'Convert the waste into nutrient-rich compost through controlled decomposition.',
        'suitability' => $suitability_composting
    ];
    
    // Method 3: Briquetting
    $suitability_briquetting = 50;
    if ($space_available == 'medium' || $space_available == 'large') {
        $suitability_briquetting = 75;
    }
    
    $methods[] = [
        'name' => 'Briquetting',
        'description' => 'Compress the waste into fuel briquettes that can be used as an alternative to firewood or coal.',
        'suitability' => $suitability_briquetting
    ];
    
    // Sort methods by suitability (descending)
    usort($methods, function($a, $b) {
        return $b['suitability'] - $a['suitability'];
    });
    
    return $methods;
}

// Function to get solar devices based on region, budget, and solar panels availability
function getSolarDevices($conn, $region_id, $budget, $solar_panels) {
    // In a real application, this would query the database for suitable solar devices
    // For this example, we'll return static data
    
    $devices = [];
    
    // Device 1: Solar Dryer
    $cost_dryer = 50000;
    $roi_dryer = 2;
    
    if ($budget == 'low' || ($budget == 'medium' && $solar_panels == 'yes')) {
        $devices[] = [
            'name' => 'Solar Dryer',
            'description' => 'Use solar energy to dry agricultural waste and products, reducing moisture content for better storage and processing.',
            'cost' => $cost_dryer,
            'roi_period' => $roi_dryer
        ];
    }
    
    // Device 2: Solar-Powered Shredder
    $cost_shredder = 120000;
    $roi_shredder = 3;
    
    if ($budget == 'medium' || $budget == 'high') {
        $devices[] = [
            'name' => 'Solar-Powered Shredder',
            'description' => 'Reduce the size of agricultural waste for easier processing and faster decomposition.',
            'cost' => $cost_shredder,
            'roi_period' => $roi_shredder
        ];
    }
    
    // Device 3: Solar-Powered Briquetting Machine
    $cost_briquetting = 250000;
    $roi_briquetting = 4;
    
    if ($budget == 'high') {
        $devices[] = [
            'name' => 'Solar-Powered Briquetting Machine',
            'description' => 'Compress agricultural waste into solid fuel briquettes for use as an alternative to firewood or coal.',
            'cost' => $cost_briquetting,
            'roi_period' => $roi_briquetting
        ];
    }
    
    return $devices;
}

// Function to get product options based on waste type and budget
function getProductOptions($conn, $waste_type, $budget) {
    // In a real application, this would query the database for suitable product options
    // For this example, we'll return static data
    
    $products = [];
    
    // Product 1: Compost
    $products[] = [
        'name' => 'Organic Compost',
        'description' => 'Convert waste into nutrient-rich compost for use as a soil amendment or for sale to other farmers and gardeners.',
        'complexity' => 'Low',
        'market_demand' => 'Medium'
    ];
    
    // Product 2: Mulch
    $products[] = [
        'name' => 'Mulch',
        'description' => 'Process waste into mulch for weed suppression, moisture conservation, and soil improvement.',
        'complexity' => 'Low',
        'market_demand' => 'Medium'
    ];
    
    // Product 3: Fuel Briquettes
    if ($budget == 'medium' || $budget == 'high') {
        $products[] = [
            'name' => 'Fuel Briquettes',
            'description' => 'Compress waste into solid fuel briquettes for use as a clean-burning alternative to firewood or coal.',
            'complexity' => 'Medium',
            'market_demand' => 'High'
        ];
    }
    
    // Product 4: Biochar
    if ($budget == 'high') {
        $products[] = [
            'name' => 'Biochar',
            'description' => 'Convert waste into biochar through pyrolysis for use as a soil amendment that improves fertility and carbon sequestration.',
            'complexity' => 'High',
            'market_demand' => 'High'
        ];
    }
    
    return $products;
}

// Function to calculate estimated income from waste
function calculateEstimatedIncome($waste_type, $total_waste) {
    // In a real application, this would use market rates and conversion factors
    // For this example, we'll use static rates
    
    $per_ton_rate = 2000; // ₹2,000 per ton
    
    $total_income = $per_ton_rate * $total_waste;
    
    return [
        'per_ton' => $per_ton_rate,
        'total' => $total_income
    ];
}

// Function to calculate solar suitability score
function calculateSolarScore($solar_potential, $space_available) {
    $base_score = 0;
    
    // Score based on solar potential
    switch ($solar_potential) {
        case 'Very High':
            $base_score = 9;
            break;
        case 'High':
            $base_score = 8;
            break;
        case 'Medium':
            $base_score = 6;
            break;
        case 'Low':
            $base_score = 4;
            break;
        default:
            $base_score = 5;
    }
    
    // Adjust score based on space available
    $space_adjustment = 0;
    switch ($space_available) {
        case 'large':
            $space_adjustment = 1;
            break;
        case 'medium':
            $space_adjustment = 0;
            break;
        case 'small':
            $space_adjustment = -0.5;
            break;
        case 'none':
            $space_adjustment = -1;
            break;
    }
    
    $final_score = $base_score + $space_adjustment;
    
    // Ensure score is between 1 and 10
    if ($final_score < 1) $final_score = 1;
    if ($final_score > 10) $final_score = 10;
    
    return $final_score;
}

// Function to get solar score label
function getSolarScoreLabel($solar_potential) {
    switch ($solar_potential) {
        case 'Very High':
            return 'Excellent';
        case 'High':
            return 'Very Good';
        case 'Medium':
            return 'Good';
        case 'Low':
            return 'Fair';
        default:
            return 'Average';
    }
}

// Function to get solar score description
function getSolarScoreDescription($solar_potential) {
    switch ($solar_potential) {
        case 'Very High':
            return 'Your region has excellent solar potential, making solar-powered technologies highly effective for agricultural waste management.';
        case 'High':
            return 'Your region has very good solar potential, suitable for most solar-powered agricultural technologies.';
        case 'Medium':
            return 'Your region has good solar potential, making solar-powered technologies viable with proper planning.';
        case 'Low':
            return 'Your region has fair solar potential. Solar technologies can still be used but may require larger installations or supplementary power sources.';
        default:
            return 'Your region has average solar potential. Consider seasonal variations when planning solar-powered waste management solutions.';
    }
}

// Function to save report to database
function saveReport($conn, $user_id, $region_id, $crop_type, $waste_type, $waste_amount, $farm_size, $space_available, $solar_panels, $solar_capacity, $budget, $current_practice, $notes) {
    $query = "INSERT INTO reports 
        (user_id, region_id, crop_type_id, waste_type_id, waste_amount, farm_size, space_available, solar_panels, solar_capacity, budget, current_practice, notes, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "iiiiddssdsss",
        $user_id,
        $region_id,
        $crop_type,
        $waste_type,
        $waste_amount,
        $farm_size,
        $space_available,
        $solar_panels,
        $solar_capacity,
        $budget,
        $current_practice,
        $notes
    );

    if ($stmt->execute()) {
        return $stmt->insert_id;
    } else {
        error_log("Failed to save report: " . $stmt->error);
        return null;
    }
}
