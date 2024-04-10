<!DOCTYPE html>
<?php
require_once '../gestion_server/SessionManager.php';
require_once '../login/Cdao.php';
require_once '../gestion_server/DashboardData.php';

// Check session
SessionManager::checkUserSession();

$dao = new Cdao();
$dashboardData = new DashboardData($dao);

// Retrieve data using methods from DashboardData
//$cpuMetrics = $dashboardData->getCpuMetrics();
//$gpuMetrics = $dashboardData->getGpuMetrics();
//$ramMetrics = $dashboardData->getRamMetrics();
$diskMetrics = $dashboardData->getDiskMetrics();

?>
<html lang="en">
    <head> <title>Dashboard</title> </head>
<?php include('head.php'); // Include the head content ?>
<body>
<?php include('menu.php'); // Include your menu structure ?>
    <div class="content">
        <!-- CPU Metrics -->
        <div class="info-block">
            <h3>CPU Metrics</h3>
            <canvas id="cpuChart"></canvas>
        </div>
        <!-- GPU Metrics -->
        <div class="info-block">
            <h3>GPU Metrics</h3>
            <canvas id="gpuChart"></canvas>
        </div>
        <!-- RAM Metrics -->
        <div class="info-block">
            <h3>RAM Usage</h3>
            <canvas id="ramUsageChart"></canvas>
        </div>
        <!-- Disk Metrics -->
        <div class="info-block">
            <h3>Disk Metrics</h3>
            <table class="disk-metrics-table">
                <thead>
                    <tr>
                        <th>Disk</th>
                        <th>Used space</th>
                        <th>Free space</th>
                        <th>Usage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($diskMetrics as $disk): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($disk['name']); ?></td>
                        <td><?php echo htmlspecialchars($disk['used']); ?> GB</td>
                        <td><?php echo htmlspecialchars($disk['free']); ?> GB</td>
                        <td><?php echo htmlspecialchars($disk['Usage']); ?>%</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cpuChartCtx = document.getElementById('cpuChart').getContext('2d');
            const cpuChart = new Chart(cpuChartCtx, {
                type: 'line',
                data: {
                    labels: [/* labels for your CPU data */],
                    datasets: [{
                        label: 'CPU Usage (%)',
                        data: [/* CPU usage data */],
                        borderColor: 'rgb(255, 99, 132)',
                        fill: false,
                    }, {
                        label: 'CPU Temperature (°C)',
                        data: [/* CPU temperature data */],
                        borderColor: 'rgb(54, 162, 235)',
                        fill: false,
                    }]
                }
            });

            const gpuChartCtx = document.getElementById('gpuChart').getContext('2d');
            const gpuChart = new Chart(gpuChartCtx, {
                type: 'line',
                data: {
                    labels: [/* labels for your GPU data */],
                    datasets: [{
                        label: 'GPU Usage (%)',
                        data: [/* GPU usage data */],
                        borderColor: 'rgb(255, 206, 86)',
                        fill: false,
                    }, {
                        label: 'GPU Temperature (°C)',
                        data: [/* GPU temperature data */],
                        borderColor: 'rgb(75, 192, 192)',
                        fill: false,
                    }]
                }
            });

            const ramUsageCtx = document.getElementById('ramUsageChart').getContext('2d');
            const ramUsageChart = new Chart(ramUsageCtx, {
                type: 'line',
                data: {
                    labels: [/* labels for your RAM data */],
                    datasets: [{
                        label: 'RAM Usage (%)',
                        data: [/* RAM usage data */],
                        borderColor: 'rgb(153, 102, 255)',
                        fill: false,
                    }]
                }
            });
        });
    </script>
</body>
</html>