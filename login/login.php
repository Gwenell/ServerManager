<?php
// Start a new session or resume the existing one.
session_start();

// Include the Cdao class file for database operations.
include('Cdao.php');

// Create a new instance of the Cdao class.
$dao = new Cdao();

// Initialize an empty message string to hold potential messages for the user.
$message = "";

// Check if the form was submitted using POST method.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and store user input.
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password']; // Don't sanitize passwords; hashing will occur in Cdao.php.
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

    // Handle registration.
    if ($action === 'register' && $username && $password && $email) {
        // Attempt to register the user using the Cdao method.
        $result = $dao->registerUser($username, $password, $email, 'user', 'active');
        if ($result) {
            $message = "Registration successful. Please wait for administrator approval.";
        } else {
            $message = "Registration failed. The user might already exist.";
        }
    // Handle login.
    } elseif ($action === 'login' && $username && $password) {
        // Attempt to log in the user using the Cdao method.
        $loginSuccess = $dao->loginUser($username, $password);
        if ($loginSuccess) {
            // Redirect to the dashboard if login is successful.
            header("Location: ../gestion_server/dashboard.php");
            exit;
        } else {
            $message = "Incorrect username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../gestion_server/head.php'); ?>
<body class="bg-gray-200">
    <div class="flex items-center justify-center h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <form action="" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email" name="email">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="action" value="login">Login</button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="action" value="register">Register</button>
                    </div>
                </form>
                <?php if ($message): ?>
                    <div class="mt-4">
                        <p class="text-center text-red-500"><?= $message; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>