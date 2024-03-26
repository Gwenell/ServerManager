<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
    <title>Git Pull Page</title>
</head>
<body class="bg-gray-200">
    <div class="flex items-center justify-center h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <form action="pull.php" method="post">
                    <input type="hidden" name="action" value="gitpull">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Pull from Git</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    // Vérification si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'gitpull') {

        $password = '212002';
        $command = 'echo ' . escapeshellarg($password) . ' | sudo -S git pull';

        echo "<pre>Commande simulée : $command</pre>";

        $output = shell_exec($command);
        echo "<pre>$output</pre>";
    }
    ?>
</body>
</html>
