<!DOCTYPE html>
<?php 
session_start();
require_once('cdao.php');
$odao = new Cdao();

$message = "";

// Traitement de l'inscription
if(isset($_POST['register']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashage du mot de passe
    $email = $_POST['email'];
    $role = 'user'; // Rôle par défaut lors de l'inscription
    $status = 'pending approval'; // Statut par défaut lors de l'inscription
    
    // Tentative d'inscription de l'utilisateur
    $result = $odao->registerUser($username, $password, $email, $role, $status);
    if ($result) {
        $message = "Inscription réussie. Veuillez attendre l'activation par un administrateur.";
    } else {
        $message = "L'inscription a échoué. L'utilisateur existe peut-être déjà.";
    }
}

// Traitement de la connexion
if(isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Tentative de connexion de l'utilisateur
    $loginSuccess = $odao->loginUser($username, $password);
    if ($loginSuccess) {
        header("Location: dashboard.php"); // Redirection vers le tableau de bord
        exit();
    } else {
        $message = "Identifiant ou mot de passe incorrect.";
    }
}
?>
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
                <?php if (!empty($message)): ?>
                    <p class="text-center text-red-500 mt-4"><?= $message; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
