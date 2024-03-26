<?php
session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Change '/path/to/your/repo' to the actual path of your Git repository
    $repositoryPath = '/var/www/html/ServerManager';

    // Run the git pull command in the specified directory and capture the output
    $output = shell_exec('cd ' . escapeshellarg($repositoryPath) . ' && git pull 2>&1');
    
    // Display the output
    echo "<pre>$output</pre>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Git Pull Button</title>
</head>
<body>
    <!-- The form sends a POST request to the same PHP script -->
    <form action="" method="post">
        <input type="submit" value="Pull from Git">
    </form>
</body>
</html>
