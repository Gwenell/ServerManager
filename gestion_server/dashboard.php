<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); // Include the head content ?>
<body>
    <!-- Include your menu structure -->
    <?php include('menu.php'); ?>

    <div class="content">
        <div id="charts">
            <!-- Chart containers -->
            <div class="content">
        <div class="cpu-gpu-container">
            <!-- CPU Info side by side -->
            <div class="info-block">
                <h3>CPU Usage</h3>
                <canvas id="cpuUsageChart"></canvas>
            </div>
            <div class="info-block">
                <h3>CPU Temperature</h3>
                <canvas id="cpuTempChart"></canvas>
            </div>
        </div>
        
        <div class="cpu-gpu-container">
            <!-- GPU Info side by side -->
            <div class="info-block">
                <h3>GPU Usage</h3>
                <canvas id="gpuUsageChart"></canvas>
            </div>
            <div class="info-block">
                <h3>GPU Temperature</h3>
                <canvas id="gpuTempChart"></canvas>
            </div>
        </div>
        
        <!-- RAM Usage -->
        <div class="info-block">
            <h3>RAM Usage</h3>
            <canvas id="ramUsageChart"></canvas>
        </div>
            <!-- Add more charts as needed -->
        </div>
                <!-- Disk Information -->
            <div class="disk-info-container">
                <!-- Chaque disque aura un élément .disk qui contient ses informations -->
                    <div class="disk">
                        <h4>Disk C:</h4>
                        <!-- Placeholder pour les informations sur le disque -->
                        <p>Used space: ...</p>
                        <p>Free space: ...</p>
                        <!-- Ajouter des éléments pour la visualisation de l'utilisation -->
                    </div>
                    <!-- Répéter pour d'autres disques -->
            </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialization and update functions for charts...
    </script>
</body>
</html>
