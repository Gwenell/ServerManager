<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ici, nous utilisons la fonction shell_exec pour exécuter git pull.
    // Vous devez vous assurer que l'utilisateur PHP a les bonnes permissions pour exécuter git pull dans le répertoire du projet.
    // De plus, pour des raisons de sécurité, il est conseillé de restreindre l'accès à cette page via une authentification.
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
    <!-- 
        Assurez-vous que cette page est protégée par une authentification pour éviter que quelqu'un de non autorisé puisse exécuter le git pull.
    -->
    <form action="git-pull.php" method="post">
        <input type="submit" value="Pull from Git">
    </form>
</body>
</html>
