<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
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
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="login">Login</button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="register">Register</button>
                    </div>
                </form>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

                    if ($action === 'register' && !empty($username) && !empty($password) && !empty($email)) {
                        // Inscription
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $result = $odao->registerUser($username, $hashedPassword, $email, 'user', 'active');
                        if ($result) {
                            $message = "Inscription réussie. Veuillez attendre l'activation par un administrateur.";
                        } else {
                            $message = "L'inscription a échoué. L'utilisateur existe peut-être déjà.";
                        }
                    } elseif ($action === 'login' && !empty($username) && !empty($password)) {
                        // Connexion
                        $loginSuccess = $odao->loginUser($username, $password);
                        if ($loginSuccess) {
                            header("Location: dashboard.php"); // Redirection vers le tableau de bord
                            exit();
                        } else {
                            $message = "Identifiant ou mot de passe incorrect.";
                        }
                    }
                    
                    if (!empty($message)) {
                        echo "<p class='text-center text-red-500 mt-4'>$message</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
