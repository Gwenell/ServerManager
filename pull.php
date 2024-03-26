<?php
session_start();

// Supposons que vous avez une variable de session qui détermine si l'utilisateur est connecté
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: login.php');
    exit();
}

// Vérifiez si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Exécutez git pull dans le répertoire spécifié
    $output = shell_exec('cd /path/to/your/repo && git pull 2>&1'); // Assurez-vous de remplacer '/path/to/your/repo' par le chemin réel
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
    <form action="" method="post">
        <input type="submit" value="Pull from Git">
    </form>
</body>
</html>
