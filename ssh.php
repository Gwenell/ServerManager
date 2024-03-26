<!DOCTYPE html>
<html>
<head>
    <title>Web SSH Terminal</title>
</head>
<body>
    <div id="terminal"></div>
    <!-- Include xterm.js for terminal functionality -->
    <script src="https://cdn.jsdelivr.net/npm/xterm/lib/xterm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xterm-addon-fit/lib/xterm-addon-fit.js"></script>
    <script>
        let term = new Terminal({
            cursorBlink: true
        });

        // Define the WebSocket URL
        let socket = new WebSocket('ws://localhost:8080'); // Make sure to use wss:// in a production environment

        socket.onopen = function(e) {
            term.open(document.getElementById('terminal'));
            term.writeln('Welcome to SSH Web Terminal.');
            term.writeln('Please login with your username.');
            term.write('Username: gwenell\r\n'); // Set the default username
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
                // e.g. server process killed or network down
                console.log('[close] Connection died');
            }
        };
    </script>
</body>
</html>
