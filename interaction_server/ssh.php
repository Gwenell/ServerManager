<!DOCTYPE html>
<?php
require_once '../gestion_server/SessionManager.php';
require_once '../login/Cdao.php';

// Check session
SessionManager::checkUserSession();

$dao = new Cdao();

// You can now use $dashboardData to retrieve the necessary data
// and pass them to your JavaScript scripts for display via Chart.js

?>
<html lang="en">
<head> <title>SSH</title> </head>
<?php include('../gestion_server/head.php'); ?>
<body class="flex">

<?php include('../gestion_server/menu.php'); ?>

<div class="content" style="flex-grow: 1; height: 100vh;">
    <div id="terminal" style="width: 100%; height: 100%;"></div>
    <!-- Include xterm.js for terminal functionality -->
    <script src="https://cdn.jsdelivr.net/npm/xterm/lib/xterm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xterm-addon-fit/lib/xterm-addon-fit.js"></script>
    <script>
        let term = new Terminal({
            cursorBlink: true
        });

        // Define the WebSocket URL
        let socket = new WebSocket('ws://localhost:8080');

        socket.onopen = function(e) {
            term.open(document.getElementById('terminal'));
            term.writeln('Welcome to SSH Web Terminal.');
            term.writeln('Please login with your username.');
            // Note: Do not automatically send passwords or sensitive information

            term.onData(function(data) {
                socket.send(data); // Data from terminal to server
            });

            socket.onmessage = function(event) {
                term.write(event.data); // Data from server to terminal
            };

            // Add additional error handling for WebSocket as needed
        };

        socket.onerror = function(event) {
            console.error('WebSocket error observed:', event);
        };

        socket.onclose = function(event) {
            if (event.wasClean) {
                console.log(`[close] Connection closed cleanly, code=${event.code}, reason=${event.reason}`);
            } else {
                // server process killed or network down
                console.log('[close] Connection died');
            }
        };
    </script>
</div>
</body>
</html>
