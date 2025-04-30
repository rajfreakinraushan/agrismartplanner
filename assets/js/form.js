document.addEventListener('DOMContentLoaded', function() {
    // Waste optimizer form functionality
    const cropTypeSelect = document.getElementById('crop_type');
    const wasteTypeSelect = document.getElementById('waste_type');
    const solarPanelsRadios = document.querySelectorAll('input[name="solar_panels"]');
    const solarCapacityGroup = document.getElementById('solar_capacity_group');
    
    // Crop type change handler
    if (cropTypeSelect && wasteTypeSelect) {
        cropTypeSelect.addEventListener('change', function() {
            const cropId = this.value;
            
            if (cropId) {
                // Enable waste type select
                wasteTypeSelect.disabled = false;
                
                // In a real application, this would fetch waste types from the server
                // For this example, we'll use static data
                wasteTypeSelect.innerHTML = '<option value="">-- Select Waste Type --</option>';
                
                // Sample waste types for different crops
                const wasteTypes = {
                    '1': [
                        { id: 1, name: 'Paddy Straw' },
                        { id: 2, name: 'Rice Husk' }
                    ],
                    '2': [
                        { id: 3, name: 'Wheat Straw' },
                        { id: 4, name: 'Wheat Chaff' }
                    ],
                    '3': [
                        { id: 5, name: 'Cotton Stalks' },
                        { id: 6, name: 'Cotton Gin Waste' }
                    ],
                    '4': [
                        { id: 7, name: 'Sugarcane Trash' },
                        { id: 8, name: 'Sugarcane Bagasse' }
                    ],
                    '5': [
                        { id: 9, name: 'Coconut Husks' },
                        { id: 10, name: 'Coconut Shells' }
                    ],
                    '6': [
                        { id: 11, name: 'Mustard Stalks' },
                        { id: 12, name: 'Mustard Husk' }
                    ],
                    '7': [
                        { id: 13, name: 'Soybean Residue' },
                        { id: 14, name: 'Soybean Pods' }
                    ],
                    '8': [
                        { id: 15, name: 'Groundnut Shells' },
                        { id: 16, name: 'Groundnut Haulms' }
                    ],
                    '9': [
                        { id: 17, name: 'Pearl Millet Straw' },
                        { id: 18, name: 'Pearl Millet Husk' }
                    ],
                    '10': [
                        { id: 19, name: 'Chickpea Residue' },
                        { id: 20, name: 'Chickpea Pods' }
                    ]
                };
                
                // Add waste types for selected crop
                if (wasteTypes[cropId]) {
                    wasteTypes[cropId].forEach(wasteType => {
                        const option = document.createElement('option');
                        option.value = wasteType.id;
                        option.textContent = wasteType.name;
                        wasteTypeSelect.appendChild(option);
                    });
                }
            } else {
                // Disable waste type select if no crop selected
                wasteTypeSelect.disabled = true;
                wasteTypeSelect.innerHTML = '<option value="">-- Select Crop Type First --</option>';
            }
        });
    }
    
    // Solar panels radio change handler
    if (solarPanelsRadios && solarCapacityGroup) {
        solarPanelsRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'yes') {
                    solarCapacityGroup.style.display = 'block';
                    document.getElementById('solar_capacity').required = true;
                } else {
                    solarCapacityGroup.style.display = 'none';
                    document.getElementById('solar_capacity').required = false;
                }
            });
        });
    }
    
    // Form validation
    const optimizerForm = document.getElementById('optimizer-form');
    
    if (optimizerForm) {
        optimizerForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate crop type
            if (!cropTypeSelect.value) {
                isValid = false;
                cropTypeSelect.classList.add('error');
            } else {
                cropTypeSelect.classList.remove('error');
            }
            
            // Validate waste type
            if (!wasteTypeSelect.value) {
                isValid = false;
                wasteTypeSelect.classList.add('error');
            } else {
                wasteTypeSelect.classList.remove('error');
            }
            
            // If form is not valid, prevent submission
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    }
});