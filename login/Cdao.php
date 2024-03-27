<?php

class Cdao
{
    private function getObjetPDO()
    {
        $strConnection = 'mysql:host=172.17.0.2;dbname=ServerManager'; // DSN
        $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); // format utf-8
        $pdo = new PDO($strConnection, 'root', 'root', $arrExtraParam); // Changez 'root' et '' si votre DB a différents username et password
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getTabDataFromSql($squery, $parameters = [])
    {
        $lepdo = $this->getObjetPDO();
        $sth = $lepdo->prepare($squery);
        $sth->execute($parameters);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function registerUser($username, $password, $email, $role, $status)
    {
        $lepdo = $this->getObjetPDO();
        $sth = $lepdo->prepare("INSERT INTO Users (Username, Password, Email, Role, Status) VALUES (?, ?, ?, ?, ?)");
        return $sth->execute([$username, $password, $email, $role, $status]);
    }

    public function loginUser($username, $password)
    {
        $userInfo = $this->getTabDataFromSql("SELECT * FROM Users WHERE Username = ?", [$username]);
        if (!empty($userInfo) && password_verify($password, $userInfo[0]['Password'])) {
            // Après la connexion réussie, vous pouvez définir des variables de session ou effectuer d'autres opérations
            $_SESSION['user_id'] = $userInfo[0]['UserID']; // Exemple de définition de la variable de session
            return true;
        }
        return false;
    }
}
