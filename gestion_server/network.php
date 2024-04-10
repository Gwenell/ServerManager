<!DOCTYPE html>
<?php
session_start();

// Check if the session variable for the logged-in user is set
if (!isset($_SESSION['user_id'])) {
    // If not set, redirect the user to the login page
    header('Location: ../login/login.php');
    exit(); // Ensure no further code is executed after the redirection
}

?>
<html lang="en">
    <head> <title>Network</title> </head>
<?php include('../gestion_server/head.php'); // Include the head content ?>
<body>
    <?php include('../gestion_server/menu.php'); // Include your menu structure ?>
    
    <!-- Content area -->
    <div class="content">
        <!-- You can place content here as needed -->
    </div>

</body>
</html>
