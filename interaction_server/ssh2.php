<!DOCTYPE html>
<html lang="fr">
<?php include('../gestion_server/head.php'); ?>

<body class="bg-gray-200">
  <div class="flex h-screen">

    <!-- Sidebar / Menu -->
    <?php include('../gestion_server/menu.php'); ?>

    <!-- Content Area -->
    <div class="content flex-grow">
      <div id="terminal" class="h-full"></div>

      <script src="https://cdn.jsdelivr.net/npm/xterm/lib/xterm.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/xterm-addon-fit/lib/xterm-addon-fit.js"></script>
      <script>
        const term = new Terminal({
          cursorBlink: true,
          theme: {
            background: 'black'
          }
        });
        term.open(document.getElementById('terminal'));

        term.writeln('Bienvenue à la démo du terminal SSH');
        term.writeln('Il s\'agit d\'une session SSH simulée.');
        term.writeln('');
        term.write('ssh:~$ ');

        // Simuler l'entrée et la réponse de l'utilisateur
        term.onData(e => {
          switch (e) {
            case '\r': // Enter
              term.write('\r\nssh:~$ ');
              break;
            case '\u007F': // Backspace (DEL)
              // Ne faites rien si la ligne est vide ou que le curseur est après "$ "
              if (term._core.buffer.x > 6) { // Adjusted for the default prompt
                term.write('\b \b');
              }
              break;
            default:
              term.write(e);
              break;
          }
        });
      </script>
    </div>
  </div>
</body>
</html>
