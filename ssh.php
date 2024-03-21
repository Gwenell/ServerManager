<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web SSH Terminal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/xterm/css/xterm.css" />
    <script src="https://cdn.jsdelivr.net/npm/xterm/lib/xterm.js"></script>
</head>
<body>
    <div id="terminal"></div>

    <script>
        const term = new Terminal();
        term.open(document.getElementById('terminal'));
        term.write('Web SSH Terminal\\r\\n');

        // Exemple d'envoi de commandes au serveur (côté client seulement pour la démo)
        term.onData(data => {
            // Ici, vous devriez envoyer les données à votre serveur via WebSocket ou une autre méthode.
            console.log(`Data from terminal: ${data}`);
        });

        // Simuler la réception de données du serveur
        term.write('Simulating server response...\\r\\n');

        // Fonction pour écrire dans le terminal de la part du serveur
        function writeToTerminal(dataFromServer) {
            term.write(dataFromServer);
        }

        // Exemple d'utilisation de la fonction
        writeToTerminal('Welcome to the server!\\r\\n');
    </script>
</body>
</html>
