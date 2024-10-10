// Biodiversity Chart using Chart.js
const biodiversityCtx = document.getElementById('biodiversityChart').getContext('2d');
const biodiversityChart = new Chart(biodiversityCtx, {
    type: 'bar',
    data: {
        labels: ['Species A', 'Species B', 'Species C', 'Species D'],
        datasets: [{
            label: 'Number of Species',
            data: [300, 500, 200, 400],
            backgroundColor: ['#3498db', '#e74c3c', '#2ecc71', '#f1c40f'],
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Forest Cover Chart using Chart.js
const forestCtx = document.getElementById('forestChart').getContext('2d');
const forestChart = new Chart(forestCtx, {
    type: 'line',
    data: {
        labels: ['2000', '2005', '2010', '2015', '2020'],
        datasets: [{
            label: 'Forest Cover (Million Hectares)',
            data: [4000, 3800, 3600, 3400, 3200],
            borderColor: '#2ecc71',
            fill: false
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


// Initialize the map with Leaflet.js
const map = L.map('map').setView([0, 0], 2); // Center the map at a global view

// Add OpenStreetMap tile layer to the map
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


// Conservation Table Data (using static example data for now)
const conservationTableBody = document.querySelector('#conservationTable tbody');
const conservationData = [
    { country: 'Brazil', area: '28%', reserves: 12 },
    { country: 'Canada', area: '25%', reserves: 18 },
    { country: 'India', area: '21%', reserves: 10 },
    { country: 'Australia', area: '23%', reserves: 15 }
];

conservationData.forEach(row => {
    const tr = document.createElement('tr');
    tr.innerHTML = `<td>${row.country}</td><td>${row.area}</td><td>${row.reserves}</td>`;
    conservationTableBody.appendChild(tr);
});