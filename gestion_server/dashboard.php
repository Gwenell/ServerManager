<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); // Include the head content ?>
<body>
    <?php include('menu.php'); // Include your menu structure ?>

    <div class="content">
        <!-- CPU Usage and Temperature -->
        <div class="info-block">
            <h3>CPU Metrics</h3>
            <canvas id="cpuChart"></canvas>
        </div>

        <!-- GPU Usage and Temperature -->
        <div class="info-block">
            <h3>GPU Metrics</h3>
            <canvas id="gpuChart"></canvas>
        </div>

        <!-- RAM Usage -->
        <div class="info-block">
            <h3>RAM Usage</h3>
            <canvas id="ramUsageChart"></canvas>
        </div>

        <!-- Disk Information -->
        <div class="disk-info-container">
            <div class="disk">
                <h4>Disk C:</h4>
                <p>Used space: ...</p>
                <p>Free space: ...</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialization and update functions for charts...
        document.addEventListener('DOMContentLoaded', function () {
            // Setup for CPU chart
            const cpuChartCtx = document.getElementById('cpuChart').getContext('2d');
            const cpuChart = new Chart(cpuChartCtx, {
                type: 'line',
                data: {
                    // Use real-time data here
                    datasets: [
                        {
                            label: 'CPU Usage (%)',
                            data: [/* CPU usage data */],
                            borderColor: 'rgb(255, 99, 132)',
                            fill: false,
                        },
                        {
                            label: 'CPU Temperature (°C)',
                            data: [/* CPU temperature data */],
                            borderColor: 'rgb(54, 162, 235)',
                            fill: false,
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });

            // Setup for GPU chart
            const gpuChartCtx = document.getElementById('gpuChart').getContext('2d');
            const gpuChart = new Chart(gpuChartCtx, {
                type: 'line',
                data: {
                    // Use real-time data here
                    datasets: [
                        {
                            label: 'GPU Usage (%)',
                            data: [/* GPU usage data */],
                            borderColor: 'rgb(255, 206, 86)',
                            fill: false,
                        },
                        {
                            label: 'GPU Temperature (°C)',
                            data: [/* GPU temperature data */],
                            borderColor: 'rgb(75, 192, 192)',
                            fill: false,
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });

            // Setup for RAM Usage chart
        const ramUsageCtx = document.getElementById('ramUsageChart').getContext('2d');
        const ramUsageChart = new Chart(ramUsageCtx, {
            type: 'line', // Progressive Line Chart for RAM Usage
            data: {
                labels: [/* Real-time time frame data here */],
                datasets: [{
                    label: 'RAM Usage (%)',
                    data: [/* Real-time RAM usage data here */],
                    borderColor: 'rgb(153, 102, 255)',
                    fill: false,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 100 // Assuming the usage percentage won't exceed 100%
                    }
                }
            }
        });

        // Placeholder values for Disk C: chart
        const diskSpaceData = {
            used: 70, // Example used space in percentage
            free: 30  // Example free space in percentage
        };

        // Setup for Disk Space chart
        const diskSpaceCtx = document.getElementById('diskChart').getContext('2d');
        const diskSpaceChart = new Chart(diskSpaceCtx, {
            type: 'bar', // Bar Chart to represent Disk Space
            data: {
                labels: ['Disk C:'],
                datasets: [
                    {
                        label: 'Used Space (%)',
                        data: [diskSpaceData.used],
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Free Space (%)',
                        data: [diskSpaceData.free],
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        stacked: true, // Stack the bars on top of each other
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true, // Stack the bars on top of each other
                        suggestedMax: 100 // The total space won't exceed 100%
                    }
                }
            }
        });

        });
    </script>
</body>
</html>
