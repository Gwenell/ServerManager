<!DOCTYPE html>
<html>
<head>
    <title>Terminal SSH Web</title>
</head>
<body>
    <div id="terminal"></div>
    <script src="https://cdn.jsdelivr.net/npm/xterm/lib/xterm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xterm-addon-fit/lib/xterm-addon-fit.js"></script>
    <script>
        let term = new Terminal();
        let socket = new WebSocket('ws://localhost:8080');
        socket.onopen = function(e) {
            term.open(document.getElementById('terminal'));
            term.onData(function(data) {
                socket.send(data);
            });
            socket.onmessage = function(event) {
                term.write(event.data);
            };
        };
    </script>
</body>
</html>
