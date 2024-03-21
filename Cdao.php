<?php

class Cdao
{
    private function getObjetPDO()
    {
        $strConnection = 'mysql:host=localhost;dbname=ServerManager'; // DSN
        $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); // format utf-8
        $pdo = new PDO($strConnection, 'root', '', $arrExtraParam);
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
            // Ici, vous pouvez définir les variables de session ou d'autres opérations après une connexion réussie
            return true;
        }
        return false;
    }
}
