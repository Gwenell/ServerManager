<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); // Ensure you have a 'head.php' file with the necessary CSS links ?>
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
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'gitpull') {
        // Execute the git pull command and capture output
        $output = shell_exec('cd /var/www/html/ServerManager && git pull 2>&1');
        echo "<pre>$output</pre>";
    }
    ?>
</body>
</html>
