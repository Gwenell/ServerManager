<!DOCTYPE html>
<?php
require_once('../gestion_server/SessionManager.php'); // Make sure the path is correct
require_once('../login/Cdao.php'); // Make sure the path is correct

SessionManager::startSession(); // Starts session if not already started
SessionManager::checkUserSession(); // Checks user session

$dao = new Cdao(); // Create a Cdao instance

// Retrieves users from the database
$users = $dao->getTabDataFromSql("SELECT UserID , Username, Email, Role, Status FROM users");
?>
<html lang="en">
<head>
    <title>Users</title>
    <?php include('../gestion_server/head.php'); // Inclut le contenu de l'en-tête ?>
</head>
<body class="bg-gray-200">
    <?php include('../gestion_server/menu.php'); // Inclut la structure du menu ?>

    <div class="flex justify-center min-h-screen">
        <div class="w-full max-w-4xl mx-auto py-8">
            <div class="bg-white shadow-xl rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Gestion des utilisateurs</h2>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="text-left text-gray-600">
                                <th class="px-4 py-3 border-b-2 border-gray-300">ID</th>
                                <th class="px-4 py-3 border-b-2 border-gray-300">Nom d'utilisateur</th>
                                <th class="px-4 py-3 border-b-2 border-gray-300">Email</th>
                                <th class="px-4 py-3 border-b-2 border-gray-300">Rôle</th>
                                <th class="px-4 py-3 border-b-2 border-gray-300">Statut</th>
                                <th class="px-4 py-3 border-b-2 border-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="px-4 py-3 border-b border-gray-300"><?php echo htmlspecialchars($user['UserID']); ?></td>
                                <td class="px-4 py-3 border-b border-gray-300"><?php echo htmlspecialchars($user['Username']); ?></td>
                                <td class="px-4 py-3 border-b border-gray-300"><?php echo htmlspecialchars($user['Email']); ?></td>
                                <td class="px-4 py-3 border-b border-gray-300"><?php echo htmlspecialchars($user['Role']); ?></td>
                                <td class="px-4 py-3 border-b border-gray-300"><?php echo htmlspecialchars($user['Status']); ?></td>
                                <td class="px-4 py-3 border-b border-gray-300">
                                    <a href="users_edit/edit_user.php?id=<?php echo $user['UserID']; ?>" class="text-blue-600 hover:underline">Modifier</a> | 
                                    <a href="users_edit/delete_user.php?id=<?php echo $user['UserID']; ?>" class="text-red-600 hover:underline">Supprimer</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>