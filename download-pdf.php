<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if report ID is provided
if(!isset($_GET['report_id']) || empty($_GET['report_id'])) {
    header("Location: dashboard.php");
    exit();
}

$report_id = $_GET['report_id'];

// Database connection
include 'includes/db_connect.php';
include 'includes/functions.php';

// In a real application, this would fetch the report data from the database
// For this example, we'll use static data

// Include TCPDF library
require_once('vendor/tcpdf/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('AgriSmart Planner');
$pdf->SetAuthor('AgriSmart Planner');
$pdf->SetTitle('AgriSmart Planner Report');
$pdf->SetSubject('Agricultural Waste Management Report');
$pdf->SetKeywords('AgriSmart, Waste, Management, Solar, Agriculture');

// Set default header data
$pdf->SetHeaderData('', 0, 'AgriSmart Planner Report', 'Generated on ' . date('Y-m-d H:i:s'));

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Sample report data
$report_data = [
    'user_name' => $_SESSION['user_name'],
    'region' => 'Punjab',
    'crop' => 'Rice',
    'waste_type' => 'Paddy Straw',
    'waste_amount' => 5.2,
    'farm_size' => 10.5,
    'total_waste' => 54.6,
    'solar_score' => 8,
    'solar_label' => 'Very Good',
    'disposal_methods' => [
        [
            'name' => 'In-situ Incorporation',
            'description' => 'Incorporate the waste directly into the soil to improve organic matter content and soil health.',
            'suitability' => 85
        ],
        [
            'name' => 'Composting',
            'description' => 'Convert the waste into nutrient-rich compost through controlled decomposition.',
            'suitability' => 90
        ],
        [
            'name' => 'Briquetting',
            'description' => 'Compress the waste into fuel briquettes that can be used as an alternative to firewood or coal.',
            'suitability' => 75
        ]
    ],
    'solar_devices' => [
        [
            'name' => 'Solar Dryer',
            'description' => 'Use solar energy to dry agricultural waste and products, reducing moisture content for better storage and processing.',
            'cost' => 50000,
            'roi_period' => 2
        ],
        [
            'name' => 'Solar-Powered Shredder',
            'description' => 'Reduce the size of agricultural waste for easier processing and faster decomposition.',
            'cost' => 120000,
            'roi_period' => 3
        ]
    ],
    'product_options' => [
        [
            'name' => 'Organic Compost',
            'description' => 'Convert waste into nutrient-rich compost for use as a soil amendment or for sale to other farmers and gardeners.',
            'complexity' => 'Low',
            'market_demand' => 'Medium'
        ],
        [
            'name' => 'Fuel Briquettes',
            'description' => 'Compress waste into solid fuel briquettes for use as a clean-burning alternative to firewood or coal.',
            'complexity' => 'Medium',
            'market_demand' => 'High'
        ]
    ],
    'estimated_income' => [
        'per_ton' => 2000,
        'total' => 109200
    ]
];

// Write HTML content
$html = '
<h1 style="text-align: center; color: #4CAF50;">AgriSmart Planner Report</h1>
<p style="text-align: center;">Generated for: ' . $report_data['user_name'] . ' | Date: ' . date('Y-m-d') . '</p>
<hr style="border-top: 2px solid #4CAF50;">

<h2 style="color: #4CAF50;">Input Summary</h2>
<table cellpadding="5">
    <tr>
        <td width="30%"><strong>Region:</strong></td>
        <td width="70%">' . $report_data['region'] . '</td>
    </tr>
    <tr>
        <td><strong>Crop Type:</strong></td>
        <td>' . $report_data['crop'] . '</td>
    </tr>
    <tr>
        <td><strong>Waste Type:</strong></td>
        <td>' . $report_data['waste_type'] . '</td>
    </tr>
    <tr>
        <td><strong>Waste Amount:</strong></td>
        <td>' . $report_data['waste_amount'] . ' tons/acre</td>
    </tr>
    <tr>
        <td><strong>Farm Size:</strong></td>
        <td>' . $report_data['farm_size'] . ' acres</td>
    </tr>
    <tr>
        <td><strong>Total Waste:</strong></td>
        <td>' . $report_data['total_waste'] . ' tons</td>
    </tr>
</table>

<h2 style="color: #4CAF50; margin-top: 20px;">Solar Suitability Score</h2>
<p><strong>Score:</strong> ' . $report_data['solar_score'] . '/10 (' . $report_data['solar_label'] . ')</p>

<h2 style="color: #4CAF50; margin-top: 20px;">Best Residue Management Methods</h2>
<ol>';

foreach($report_data['disposal_methods'] as $method) {
    $html .= '
    <li>
        <h3>' . $method['name'] . ' (' . $method['suitability'] . '% Suitable)</h3>
        <p>' . $method['description'] . '</p>
    </li>';
}

$html .= '
</ol>

<h2 style="color: #4CAF50; margin-top: 20px;">Recommended Solar-Powered Technologies</h2>
<ol>';

foreach($report_data['solar_devices'] as $device) {
    $html .= '
    <li>
        <h3>' . $device['name'] . '</h3>
        <p>' . $device['description'] . '</p>
        <p><strong>Estimated Cost:</strong> ₹' . number_format($device['cost']) . '</p>
        <p><strong>ROI Period:</strong> ' . $device['roi_period'] . ' years</p>
    </li>';
}

$html .= '
</ol>

<h2 style="color: #4CAF50; margin-top: 20px;">Product Ideas from Your Waste</h2>
<ol>';

foreach($report_data['product_options'] as $product) {
    $html .= '
    <li>
        <h3>' . $product['name'] . '</h3>
        <p>' . $product['description'] . '</p>
        <p><strong>Processing Complexity:</strong> ' . $product['complexity'] . '</p>
        <p><strong>Market Demand:</strong> ' . $product['market_demand'] . '</p>
    </li>';
}

$html .= '
</ol>

<h2 style="color: #4CAF50; margin-top: 20px;">Estimated Profit Potential</h2>
<p><strong>Estimated Income per Ton:</strong> ₹' . number_format($report_data['estimated_income']['per_ton']) . '</p>
<p><strong>Total Potential Income:</strong> ₹' . number_format($report_data['estimated_income']['total']) . '</p>
<p style="font-size: 10px; color: #666;">Note: Actual income may vary based on market conditions, processing efficiency, and other factors.</p>

<hr style="border-top: 2px solid #4CAF50; margin-top: 30px;">
<p style="text-align: center; font-size: 10px;">This report was generated by AgriSmart Planner. Visit <a href="https://agrismart-planner.com">agrismart-planner.com</a> for more information.</p>
';

// Write the HTML content to the PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('AgriSmart_Report_' . $report_id . '.pdf', 'D');

$conn->close();
?>