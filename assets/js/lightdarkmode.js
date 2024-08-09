// Set default mode to dark
if (localStorage.getItem('theme') === null) {
    localStorage.setItem('theme', 'dark');
}

// Apply theme based on localStorage
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
    document.getElementById('darkModeSwitch').innerHTML = '<i class="fas fa-sun"></i>';
} else {
    document.body.classList.remove('dark-mode');
    document.getElementById('darkModeSwitch').innerHTML = '<i class="fas fa-moon"></i>';
}

// Event listener for theme switch
document.getElementById('darkModeSwitch').addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');

    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        document.getElementById('darkModeSwitch').innerHTML = '<i class="fas fa-sun"></i>';
    } else {
        localStorage.setItem('theme', 'light');
        document.getElementById('darkModeSwitch').innerHTML = '<i class="fas fa-moon"></i>';
    }
    updateChartsForMode();
});

// Function to update chart colors based on theme
const getColorSettings = () => {
    return {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: document.body.classList.contains('dark-mode') ? 'white' : 'black'
                }
            },
            x: {
                ticks: {
                    color: document.body.classList.contains('dark-mode') ? 'white' : 'black'
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: document.body.classList.contains('dark-mode') ? 'white' : 'black'
                }
            }
        }
    };
};

const updateChartsForMode = () => {
    // Add your chart instances here
    if (overviewLineChart) overviewLineChart.options = { ...overviewLineChart.options, ...getColorSettings() };
    if (overviewBarChart) overviewBarChart.options = { ...overviewBarChart.options, ...getColorSettings() };
    if (overviewDonutChart) overviewDonutChart.options = { ...overviewDonutChart.options, ...getColorSettings() };
    if (lineChart) lineChart.options = { ...lineChart.options, ...getColorSettings() };
    if (detailBarChart) detailBarChart.options = { ...detailBarChart.options, ...getColorSettings() };

    if (overviewLineChart) overviewLineChart.update();
    if (overviewBarChart) overviewBarChart.update();
    if (overviewDonutChart) overviewDonutChart.update();
    if (lineChart) lineChart.update();
    if (detailBarChart) detailBarChart.update();
};

updateChartsForMode();