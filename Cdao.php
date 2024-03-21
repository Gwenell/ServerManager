<?php

class Cdao
{
    function filtrerChainePourBD($str) {
        // Cette fonction devrait être mise à jour ou retirée car mysql_real_escape_string est obsolète et PDO fournit des prepared statements qui sécurisent les requêtes.
        return $str;
    }

    private function getObjetPDO() {
        $strConnection = 'mysql:host=localhost;dbname=ServerManager'; // DSN
        $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); // demande format utf-8
        $pdo = new PDO($strConnection, 'root', '212002', $arrExtraParam); // Remplacez 'root' et '212002' par vos propres identifiants
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getTabDataFromSql($squery, $username = null) 
{
    $lepdo = $this->getObjetPDO();
    $sth = $lepdo->prepare($squery);
    if ($username !== null) {
        $sth->bindParam(':username', $username);
    }
    $sth->execute();
    $result = $sth->fetchAll();
    return $result;
}

public function insertUser($insertQuery, $username, $password, $email, $role, $status) {
    $lepdo = $this->getObjetPDO();
    $sth = $lepdo->prepare($insertQuery);
    $sth->bindParam(':username', $username);
    $sth->bindParam(':password', $password);
    $sth->bindParam(':email', $email);
    $sth->bindParam(':role', $role);
    $sth->bindParam(':status', $status);
    
    $sth->execute();
}


}
