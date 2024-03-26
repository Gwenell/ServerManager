<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set content type to UTF-8
header('Content-Type: text/html; charset=utf-8');

// Vérifiez si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous que l'utilisateur PHP a les permissions adéquates pour exécuter cette commande
    // Important : protégez cette page avec une authentification
    $output = shell_exec('git pull 2>&1'); // The 2>&1 makes sure to catch any shell errors
    echo "<pre>$output</pre>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Git Pull Button</title>
    <!-- Other head content -->
</head>
<body>
    <!-- Le formulaire pointe sur lui-même pour la requête POST -->
    <form action="" method="post">
        <!-- Add authentication verification here -->
        <input type="submit" value="Pull from Git">
    </form>
</body>
</html>
