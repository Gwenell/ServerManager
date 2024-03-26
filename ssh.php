<!DOCTYPE html>
<html>
<head>
    <title>Web SSH Terminal</title>
    <!-- Ensure any PHP code inserted here follows PHP 8.2 best practices -->
    <?php
    // Example PHP code block
    // Ensure proper error handling and type declarations
    ?>
</head>
<body>
    <div id="terminal"></div>
    <!-- Including xterm.js for terminal functionality -->
    <script src="https://cdn.jsdelivr.net/npm/xterm/lib/xterm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xterm-addon-fit/lib/xterm-addon-fit.js"></script>
    <script>
        let term = new Terminal();
        let socket = new WebSocket('ws://localhost:8080'); // Ensure this WebSocket server is properly secured
        socket.onopen = function(e) {
            term.open(document.getElementById('terminal'));
            term.onData(function(data) {
                socket.send(data); // Data from terminal to server
            });
            socket.onmessage = function(event) {
                term.write(event.data); // Data from server to terminal
            };
        };
    </script>
</body>
</html>
