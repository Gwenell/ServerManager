<?php
// DashboardData.php
class DashboardData {
    private $dao;
    private $diskDataPath = 'path/to/your/disk_metrics.json'; // Chemin vers le fichier JSON

    public function __construct(Cdao $dao) {
        $this->dao = $dao;
    }

    public function getCpuMetrics() {
        return $this->dao->getTabDataFromSql("SELECT * FROM cpu_metrics");
    }

    // ... méthodes pour GPU, RAM ...

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
