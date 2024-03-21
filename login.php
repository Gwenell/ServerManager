<!DOCTYPE html>
<?php 
session_start();
error_reporting(0);
ini_set('display_errors', 0);
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-gray-200">
    <div class="flex items-center justify-center h-screen">
        <div class="w-full max-w-xs">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="login">
                        Login
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="login" type="text" placeholder="Enter login" name="username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Enter password" name="password">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Sign In
                    </button>
                </div>
            </form>
            <?php 
            if(isset($_POST['username']) && isset($_POST['password']))
            {
                require_once('cdao.php');
                $odao = new Cdao();
                $squery = "SELECT * FROM Users WHERE Username = :username";
                $userInfo = $odao->getTabDataFromSql($squery, $_POST['username']);
                
                if (!empty($userInfo) && password_verify($_POST['password'], $userInfo[0]["Password"])) {
                    $_SESSION["UserID"] = $userInfo[0]["UserID"];
                    $_SESSION["Role"] = $userInfo[0]["Role"];
                    // Vous pouvez rediriger l'utilisateur vers la page principale ou le tableau de bord ici
                    header("Location: dashboard.php"); // Dashboard ou la page principale de l'utilisateur
                    exit();
                } else {
                    echo "<p class='text-red-500 text-xs italic'>Identifiant ou mot de passe incorrect.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
