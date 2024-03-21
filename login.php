<!DOCTYPE html>
<?php 
session_start();
require_once('cdao.php');
require_once("head.php");
?>
<html>
  <body>
    <?php
    if(isset($_POST['login2']) && isset($_POST['pwd'])) {
        $odao = new Cdao();
        $squery = 'SELECT * FROM employe';
        $tabPersonne = $odao->getTabDataFromSql($squery);
        foreach ($tabPersonne as $tab) {
            if($_POST['login2'] == $tab["login"] && password_verify($_POST['pwd'], $tab["mdp"])) {
                $_SESSION["personne"] = "OK";
                header("Location: page2.php");
                exit;
            }
        }
        echo "<p class='text-red-500'>Identifiant ou mot de passe incorrect.</p>";
    }
    ?>

    <div class="container mx-auto">
        <form action="" method="POST">
            <div class="mb-3 mt-3">
              <label for="login" class="form-label">Login:</label>
              <input type="text" class="form-control" id="login" placeholder="Enter login" name="login2">
            </div>
            <div class="mb-3">
              <label for="pwd" class="form-label">Password:</label>
              <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  </body>
</html>
