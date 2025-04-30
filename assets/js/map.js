document.addEventListener('DOMContentLoaded', function() {
    // Map area data
    const mapAreas = [
        {
            id: 1,
            name: 'Punjab',
            coords: '50,120,100,150,150,120,100,90',
            solarPotential: 'High',
            commonWaste: ['Paddy Straw', 'Wheat Straw', 'Cotton Stalks']
        },
        {
            id: 2,
            name: 'Maharashtra',
            coords: '150,300,200,350,250,300,200,250',
            solarPotential: 'Very High',
            commonWaste: ['Sugarcane Trash', 'Cotton Stalks', 'Soybean Residue']
        },
        {
            id: 3,
            name: 'Karnataka',
            coords: '150,400,200,450,250,400,200,350',
            solarPotential: 'High',
            commonWaste: ['Coconut Husks', 'Arecanut Waste', 'Rice Straw']
        },
        {
            id: 4,
            name: 'Gujarat',
            coords: '100,250,150,300,200,250,150,200',
            solarPotential: 'Very High',
            commonWaste: ['Cotton Stalks', 'Groundnut Shells', 'Castor Stalks']
        },
        {
            id: 5,
            name: 'Uttar Pradesh',
            coords: '250,150,300,200,350,150,300,100',
            solarPotential: 'Medium',
            commonWaste: ['Rice Straw', 'Wheat Straw', 'Sugarcane Trash']
        },
        {
            id: 6,
            name: 'Haryana',
            coords: '120,100,170,130,220,100,170,70',
            solarPotential: 'High',
            commonWaste: ['Rice Straw', 'Wheat Straw', 'Mustard Stalks']
        },
        {
            id: 7,
            name: 'Rajasthan',
            coords: '80,180,130,210,180,180,130,150',
            solarPotential: 'Very High',
            commonWaste: ['Mustard Stalks', 'Pearl Millet Straw', 'Guar Straw']
        },
        {
            id: 8,
            name: 'Madhya Pradesh',
            coords: '200,220,250,250,300,220,250,190',
            solarPotential: 'High',
            commonWaste: ['Soybean Residue', 'Wheat Straw', 'Chickpea Residue']
        },
        {
            id: 9,
            name: 'Tamil Nadu',
            coords: '200,450,250,480,300,450,250,420',
            solarPotential: 'Very High',
            commonWaste: ['Rice Straw', 'Sugarcane Trash', 'Coconut Husks']
        },
        {
            id: 10,
            name: 'Andhra Pradesh',
            coords: '250,350,300,380,350,350,300,320',
            solarPotential: 'High',
            commonWaste: ['Rice Straw', 'Cotton Stalks', 'Chili Plant Residue']
        }
    ];
    
    // Generate map areas
    const mapAreasContainer = document.getElementById('india-map-areas');
    
    if (mapAreasContainer) {
        mapAreas.forEach(area => {
            const areaElement = document.createElement('area');
            areaElement.setAttribute('shape', 'poly');
            areaElement.setAttribute('coords', area.coords);
            areaElement.setAttribute('alt', area.name);
            areaElement.setAttribute('title', area.name);
            areaElement.setAttribute('data-id', area.id);
            areaElement.setAttribute('data-solar', area.solarPotential);
            areaElement.setAttribute('data-waste', area.commonWaste.join(', '));
            
            mapAreasContainer.appendChild(areaElement);
        });
    }
    
    // Map area click handler
    const map = document.getElementById('india-map');
    const regionInfo = document.getElementById('region-info');
    const regionDetails = document.getElementById('region-details');
    const selectedRegionName = document.getElementById('selected-region-name');
    const solarPotential = document.getElementById('solar-potential');
    const commonWaste = document.getElementById('common-waste');
    const continueBtn = document.getElementById('continue-btn');
    const regionSelect = document.getElementById('region');
    
    if (map && regionInfo) {
        // Map area click
        document.querySelectorAll('area').forEach(area => {
            area.addEventListener('click', function(e) {
                e.preventDefault();
                
                const regionId = this.getAttribute('data-id');
                const regionName = this.getAttribute('alt');
                const regionSolar = this.getAttribute('data-solar');
                const regionWaste = this.getAttribute('data-waste').split(', ');
                
                // Update region info
                selectedRegionName.textContent = regionName;
                solarPotential.textContent = regionSolar;
                
                // Update common waste list
                commonWaste.innerHTML = '';
                regionWaste.forEach(waste => {
                    const li = document.createElement('li');
                    li.textContent = waste;
                    commonWaste.appendChild(li);
                });
                
                // Show region details
                regionDetails.style.display = 'block';
                
                // Update dropdown selection
                if (regionSelect) {
                    regionSelect.value = regionId;
                }
                
                // Update continue button
                if (continueBtn) {
                    continueBtn.onclick = function() {
                        window.location.href = `waste-optimizer.php?region=${regionId}`;
                    };
                }
            });
        });
        
        // Region dropdown change
        if (regionSelect) {
            regionSelect.addEventListener('change', function() {
                const regionId = this.value;
                
                if (regionId) {
                    const selectedOption = this.options[this.selectedIndex];
                    const regionName = selectedOption.textContent;
                    
                    // Find corresponding map area
                    const area = document.querySelector(`area[data-id="${regionId}"]`);
                    
                    if (area) {
                        const regionSolar = area.getAttribute('data-solar');
                        const regionWaste = area.getAttribute('data-waste').split(', ');
                        
                        // Update region info
                        selectedRegionName.textContent = regionName;
                        solarPotential.textContent = regionSolar;
                        
                        // Update common waste list
                        commonWaste.innerHTML = '';
                        regionWaste.forEach(waste => {
                            const li = document.createElement('li');
                            li.textContent = waste;
                            commonWaste.appendChild(li);
                        });
                        
                        // Show region details
                        regionDetails.style.display = 'block';
                        
                        // Update continue button
                        if (continueBtn) {
                            continueBtn.onclick = function() {
                                window.location.href = `waste-optimizer.php?region=${regionId}`;
                            };
                        }
                    }
                } else {
                    // Hide region details if no region selected
                    regionDetails.style.display = 'none';
                }
            });
        }
    }
});