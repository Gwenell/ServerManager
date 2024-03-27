<?php
session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Change '/path/to/your/repo' to the actual path of your Git repository
    $repositoryPath = '/var/www/html/ServerManager';

    // Run the git pull command in the specified directory and capture the output
    $output = shell_exec('cd ' . escapeshellarg($repositoryPath) . ' && sudo -u www-data git pull 2>&1');
    
    // Store the output in the session to display in the HTML below
    $_SESSION['output'] = $output;
    
    // Redirect to clear POST data
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <?php include('head.php'); ?>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-xs">
            <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <h1 class="block text-gray-700 text-xl font-bold mb-2">Mise à jour Git</h1>
                    <p class="text-sm text-gray-600 mb-4">Appuyez sur le bouton ci-dessous pour effectuer un git pull.</p>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                        Pull from Git
                    </button>
                </div>
            </form>
            <?php if (!empty($_SESSION['output'])): ?>
                <div class="bg-gray-200 rounded px-4 py-3 text-gray-700">
                    <pre class="whitespace-pre-wrap"><?php echo htmlspecialchars($_SESSION['output']); ?></pre>
                </div>
                <?php unset($_SESSION['output']); // Clear the output message ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
