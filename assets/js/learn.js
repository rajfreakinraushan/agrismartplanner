document.addEventListener('DOMContentLoaded', function() {
    // Solar capacity calculator
    const calculateSolarBtn = document.getElementById('calculate_solar');
    const solarResult = document.getElementById('solar_result');
    const solarCapacityResult = document.getElementById('solar_capacity_result');
    
    if (calculateSolarBtn && solarResult && solarCapacityResult) {
        calculateSolarBtn.addEventListener('click', function() {
            const equipmentPower = parseFloat(document.getElementById('equipment_power').value) || 0;
            const dailyUsage = parseFloat(document.getElementById('daily_usage').value) || 0;
            const sunlightHours = parseFloat(document.getElementById('sunlight_hours').value) || 0;
            
            if (equipmentPower <= 0 || dailyUsage <= 0 || sunlightHours <= 0) {
                alert('Please enter valid values for all fields.');
                return;
            }
            
            // Calculate required solar capacity
            // Formula: (Equipment Power * Daily Usage) / Sunlight Hours * 1.3 (efficiency factor)
            const requiredCapacity = (equipmentPower * dailyUsage) / sunlightHours * 1.3;
            
            // Display result
            solarCapacityResult.textContent = requiredCapacity.toFixed(2) + ' kW';
            solarResult.style.display = 'block';
        });
    }
    
    // Active navigation highlighting
    const learnNavItems = document.querySelectorAll('.learn-nav-item');
    const learnSections = document.querySelectorAll('.learn-section');
    
    if (learnNavItems.length > 0 && learnSections.length > 0) {
        // Highlight active section on scroll
        window.addEventListener('scroll', function() {
            let currentSection = '';
            
            learnSections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                const sectionHeight = section.offsetHeight;
                
                if (window.pageYOffset >= sectionTop && window.pageYOffset < sectionTop + sectionHeight) {
                    currentSection = '#' + section.getAttribute('id');
                }
            });
            
            learnNavItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentSection) {
                    item.classList.add('active');
                }
            });
        });
    }
});