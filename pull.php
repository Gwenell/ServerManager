<?php
// Vérifiez si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Exécutez git pull dans le répertoire spécifié
    // Assurez-vous que l'utilisateur PHP a les permissions adéquates pour exécuter cette commande
    // Important : protégez cette page avec une authentification
    $output = shell_exec('cd /var/www/html && git pull 2>&1');
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
    <!-- Le formulaire pointe sur lui-même pour la requête POST -->
    <form action="" method="post">
        <!-- Ajoutez une vérification d'authentification ici pour sécuriser cette action -->
        <input type="submit" value="Pull from Git">
    </form>
</body>
</html>
