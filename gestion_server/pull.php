<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $repositoryPath = '/var/www/html/ServerManager';
    $output = shell_exec('cd ' . escapeshellarg($repositoryPath) . ' && git pull 2>&1');
    echo "<pre>$output</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">
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
