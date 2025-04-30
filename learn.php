<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn - AgriSmart Planner</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <section class="page-header">
            <div class="container">
                <h1>Learn About Agricultural Waste Management</h1>
                <p>Educational resources to help you make informed decisions</p>
            </div>
        </section>
        
        <section class="learn-navigation">
            <div class="container">
                <div class="learn-nav">
                    <a href="#in-situ" class="learn-nav-item">In-situ vs Ex-situ</a>
                    <a href="#solar" class="learn-nav-item">Solar Technologies</a>
                    <a href="#products" class="learn-nav-item">Waste Products</a>
                    <a href="#case-studies" class="learn-nav-item">Case Studies</a>
                </div>
            </div>
        </section>
        
        <section id="in-situ" class="learn-section">
            <div class="container">
                <h2>In-situ vs Ex-situ Management</h2>
                
                <div class="learn-content">
                    <div class="learn-image">
                        <img src="assets/images/in-situ-ex-situ.png" alt="In-situ and Ex-situ waste management illustration">
                    </div>
                    
                    <div class="learn-text">
                        <h3>In-situ Management</h3>
                        <p>In-situ management refers to handling agricultural waste directly in the field where it was generated. This approach minimizes transportation costs and can improve soil health.</p>
                        
                        <h4>Common In-situ Methods:</h4>
                        <ul>
                            <li><strong>Mulching:</strong> Leaving crop residues on the soil surface to protect against erosion and conserve moisture.</li>
                            <li><strong>Incorporation:</strong> Mixing crop residues into the soil to enhance organic matter content.</li>
                            <li><strong>Conservation tillage:</strong> Reducing tillage operations to maintain crop residues on the soil surface.</li>
                        </ul>
                        
                        <h3>Ex-situ Management</h3>
                        <p>Ex-situ management involves collecting agricultural waste and processing it away from the field. This approach allows for more specialized processing and value addition.</p>
                        
                        <h4>Common Ex-situ Methods:</h4>
                        <ul>
                            <li><strong>Composting:</strong> Converting organic waste into nutrient-rich soil amendment.</li>
                            <li><strong>Biogas production:</strong> Generating methane-rich gas through anaerobic digestion.</li>
                            <li><strong>Briquetting:</strong> Compressing waste into solid fuel blocks for efficient burning.</li>
                            <li><strong>Pyrolysis:</strong> Converting waste into biochar, bio-oil, and syngas through heating in the absence of oxygen.</li>
                        </ul>
                        
                        <div class="comparison-table">
                            <h4>Comparison of In-situ and Ex-situ Management</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Factor</th>
                                        <th>In-situ</th>
                                        <th>Ex-situ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Cost</td>
                                        <td>Lower</td>
                                        <td>Higher</td>
                                    </tr>
                                    <tr>
                                        <td>Value Addition</td>
                                        <td>Limited</td>
                                        <td>High</td>
                                    </tr>
                                    <tr>
                                        <td>Soil Benefits</td>
                                        <td>Immediate</td>
                                        <td>Delayed/Indirect</td>
                                    </tr>
                                    <tr>
                                        <td>Income Potential</td>
                                        <td>Low</td>
                                        <td>High</td>
                                    </tr>
                                    <tr>
                                        <td>Labor Requirement</td>
                                        <td>Low</td>
                                        <td>High</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="solar" class="learn-section">
            <div class="container">
                <h2>Solar Technologies for Agricultural Waste Management</h2>
                
                <div class="learn-content">
                    <div class="learn-text">
                        <p>Solar energy can be harnessed to power various agricultural waste management processes, reducing dependence on fossil fuels and lowering operational costs in the long run.</p>
                        
                        <h3>Solar Dryers</h3>
                        <p>Solar dryers use solar energy to remove moisture from agricultural products and waste materials. They can be used to dry crops, fruits, vegetables, and even process waste materials for further use.</p>
                        
                        <h4>Types of Solar Dryers:</h4>
                        <ul>
                            <li><strong>Direct solar dryers:</strong> Products are placed in an enclosure with a transparent cover.</li>
                            <li><strong>Indirect solar dryers:</strong> Air is heated in a solar collector and then passed through the drying chamber.</li>
                            <li><strong>Mixed-mode solar dryers:</strong> Combination of direct and indirect solar drying.</li>
                        </ul>
                        
                        <h3>Solar-Powered Shredders and Grinders</h3>
                        <p>These machines reduce the size of agricultural waste, making it easier to process for composting, briquetting, or other applications.</p>
                        
                        <h3>Solar-Powered Briquetting Machines</h3>
                        <p>These machines compress agricultural waste into solid fuel briquettes that can be used as an alternative to firewood or charcoal.</p>
                        
                        <h3>Solar-Powered Biogas Systems</h3>
                        <p>Solar energy can be used to maintain optimal temperature in biogas digesters, especially in colder regions, improving the efficiency of biogas production.</p>
                    </div>
                    
                    <div class="learn-image">
                        <img src="assets/images/solar-dryer.jpg" alt="Solar dryer illustration">
                        <p class="image-caption">A typical solar dryer setup for agricultural products</p>
                    </div>
                </div>
                
                <div class="solar-calculator">
                    <h3>Solar Capacity Calculator</h3>
                    <p>Estimate the solar capacity needed for your agricultural waste processing:</p>
                    
                    <div class="calculator-form">
                        <div class="form-group">
                            <label for="equipment_power">Equipment Power Requirement (kW):</label>
                            <input type="number" id="equipment_power" min="0.1" step="0.1" value="1.0">
                        </div>
                        
                        <div class="form-group">
                            <label for="daily_usage">Daily Usage Hours:</label>
                            <input type="number" id="daily_usage" min="1" max="24" value="8">
                        </div>
                        
                        <div class="form-group">
                            <label for="sunlight_hours">Average Sunlight Hours in Your Region:</label>
                            <input type="number" id="sunlight_hours" min="1" max="12" value="5">
                        </div>
                        
                        <button id="calculate_solar" class="btn btn-primary">Calculate</button>
                        
                        <div id="solar_result" class="calculator-result" style="display: none;">
                            <h4>Recommended Solar Capacity:</h4>
                            <p id="solar_capacity_result">0 kW</p>
                            <p class="result-note">This is an estimate. Actual requirements may vary based on equipment efficiency, battery storage needs, and other factors.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="products" class="learn-section">
            <div class="container">
                <h2>Value-Added Products from Agricultural Waste</h2>
                
                <div class="product-cards">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="assets/images/products/compost.jpg" alt="Compost">
                        </div>
                        <h3>Compost</h3>
                        <p>Organic fertilizer produced by decomposing agricultural waste under controlled conditions.</p>
                        <div class="product-details">
                            <div class="detail-item">
                                <span class="label">Processing Time:</span>
                                <span class="value">2-3 months</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Equipment Needed:</span>
                                <span class="value">Low</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Market Value:</span>
                                <span class="value">₹5-15 per kg</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <div class="product-image">
                            <img src="assets/images/products/biochar.png" alt="Biochar">
                        </div>
                        <h3>Biochar</h3>
                        <p>Charcoal-like substance produced by pyrolysis of biomass, used as a soil amendment.</p>
                        <div class="product-details">
                            <div class="detail-item">
                                <span class="label">Processing Time:</span>
                                <span class="value">Hours</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Equipment Needed:</span>
                                <span class="value">Medium-High</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Market Value:</span>
                                <span class="value">₹20-50 per kg</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <div class="product-image">
                            <img src="assets/images/products/briquettes.jpg" alt="Fuel Briquettes">
                        </div>
                        <h3>Fuel Briquettes</h3>
                        <p>Compressed blocks of agricultural waste used as a clean-burning alternative to firewood.</p>
                        <div class="product-details">
                            <div class="detail-item">
                                <span class="label">Processing Time:</span>
                                <span class="value">Hours</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Equipment Needed:</span>
                                <span class="value">Medium</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Market Value:</span>
                                <span class="value">₹10-20 per kg</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <div class="product-image">
                            <img src="assets/images/products/biogas.jpg" alt="Biogas">
                        </div>
                        <h3>Biogas</h3>
                        <p>Methane-rich gas produced by anaerobic digestion of organic waste, used for cooking and electricity generation.</p>
                        <div class="product-details">
                            <div class="detail-item">
                                <span class="label">Processing Time:</span>
                                <span class="value">15-30 days</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Equipment Needed:</span>
                                <span class="value">High</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Market Value:</span>
                                <span class="value">Variable</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="more-products">
                    <h3>Other Potential Products</h3>
                    <ul class="product-list">
                        <li><strong>Mushroom Substrate:</strong> Using agricultural waste as a growing medium for mushrooms.</li>
                        <li><strong>Animal Feed:</strong> Processing certain types of agricultural waste into nutritious animal feed.</li>
                        <li><strong>Paper and Packaging:</strong> Converting fibrous agricultural waste into paper products.</li>
                        <li><strong>Handicrafts:</strong> Using dried plant materials for making baskets, mats, and other handicrafts.</li>
                        <li><strong>Bio-enzymes:</strong> Fermenting fruit and vegetable waste to produce multi-purpose cleaning agents.</li>
                    </ul>
                </div>
            </div>
        </section>
        
        <section id="case-studies" class="learn-section">
            <div class="container">
                <h2>Success Stories and Case Studies</h2>
                
                <div class="case-studies">
                    <div class="case-study">
                        <h3>Paddy Straw to Power: Punjab's Success Story</h3>
                        <div class="case-study-content">
                            <div class="case-study-image">
                                <img src="assets/images/case-studies/punjab.jpg" alt="Punjab paddy straw management">
                            </div>
                            <div class="case-study-text">
                                <p>A group of farmers in Punjab formed a cooperative to collect paddy straw and process it into fuel briquettes using solar-powered equipment. They now supply these briquettes to local industries as a replacement for coal.</p>
                                <h4>Key Achievements:</h4>
                                <ul>
                                    <li>Prevented burning of 5,000 tons of paddy straw annually</li>
                                    <li>Generated additional income of ₹15,000-20,000 per acre</li>
                                    <li>Reduced carbon emissions by 8,000 tons per year</li>
                                    <li>Created employment for 50 local youth</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="case-study">
                        <h3>Sugarcane Waste to Biochar: Maharashtra's Innovation</h3>
                        <div class="case-study-content">
                            <div class="case-study-image">
                                <img src="assets/images/case-studies/maharashtra.jpg" alt="Maharashtra sugarcane waste management">
                            </div>
                            <div class="case-study-text">
                                <p>A sugarcane farmer in Maharashtra installed a solar-powered pyrolysis unit to convert sugarcane trash into biochar. The biochar is used on his own farm and sold to neighboring farmers as a soil amendment.</p>
                                <h4>Key Achievements:</h4>
                                <ul>
                                    <li>Converted 200 tons of sugarcane trash into 40 tons of biochar</li>
                                    <li>Improved soil health and reduced fertilizer use by 30%</li>
                                    <li>Generated additional income of ₹4 lakh per year</li>
                                    <li>Reduced water requirement for irrigation by 20% due to improved soil water retention</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="case-study">
                        <h3>Coconut Waste to Crafts: Kerala's Sustainable Approach</h3>
                        <div class="case-study-content">
                            <div class="case-study-image">
                                <img src="assets/images/case-studies/kerala.jpg" alt="Kerala coconut waste management">
                            </div>
                            <div class="case-study-text">
                                <p>A women's self-help group in Kerala has developed a successful business model around coconut waste. They use solar dryers to process coconut husks and shells, which are then transformed into various handicrafts and household items.</p>
                                <h4>Key Achievements:</h4>
                                <ul>
                                    <li>Utilized waste from 100,000 coconuts annually</li>
                                    <li>Provided sustainable livelihoods for 30 women</li>
                                    <li>Exported products to international markets</li>
                                    <li>Increased household incomes by 40%</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="cta">
            <div class="container">
                <h2>Ready to optimize your farm waste management?</h2>
                <p>Apply what you've learned and get personalized recommendations for your farm.</p>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="region-selector.php" class="btn btn-primary">Launch AgriSmart Planner</a>
                <?php else: ?>
                    <a href="register.php" class="btn btn-primary">Sign Up Now</a>
                    <a href="login.php" class="btn btn-secondary">Log In</a>
                <?php endif; ?>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/learn.js"></script>
</body>
</html>