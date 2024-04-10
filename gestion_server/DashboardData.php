<?php
// DashboardData.php
class DashboardData {
    private $dao;
    private $diskDataPath = 'path/to/your/disk_metrics.json'; // Chemin vers le fichier JSON
    // private $cpuDataPath = 'path/to/your/cpuDataPath.json';
    // private $gpuDataPath = 'path/to/your/gpuDataPath.json';
    // private $ramDataPath = 'path/to/your/ramDataPath.json';

    public function __construct(Cdao $dao) {
        $this->dao = $dao;
    }

    public function getCpuMetrics() {
        // Example data, replace with your actual data retrieval
        $data = [];
        for ($i = 0; $i < 5 * 60; $i += 20) {
            $data[] = ['time' => $i, 'usage' => mt_rand(0, 100), 'temperature' => mt_rand(20, 80)];
        }
        return $data;
    }

    public function getGpuMetrics() {
        // Example data, replace with your actual data retrieval
        $data = [];
        for ($i = 0; $i < 5 * 60; $i += 20) {
            $data[] = ['time' => $i, 'usage' => mt_rand(0, 100), 'temperature' => mt_rand(30, 70)];
        }
        return $data;
    }

    public function getRamMetrics() {
        // Example data, replace with your actual data retrieval
        $data = [];
        for ($i = 0; $i < 5 * 60; $i += 20) {
            $data[] = ['time' => $i, 'usage' => mt_rand(0, 100)];
        }
        return $data;
    }

    public function getDiskMetrics() {
        /*$diskDataPath = '../path/to/your/disk_data.json';
        $jsonData = file_get_contents($diskDataPath);
        return json_decode($jsonData, true);*/
        return [
            ['name' => 'Disk C', 'used' => 50, 'free' => 50, 'Usage' => 50],
            ['name' => 'Disk D', 'used' => 30, 'free' => 70, 'Usage' => 50],
            // Ajoutez autant de disques que nécessaire...
        ];
    }
}
