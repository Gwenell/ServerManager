<?php

class Cdao
{
    private $pdo;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $strConnection = 'mysql:host=localhost;dbname=servermanager'; // DSN
        try {
            $this->pdo = new PDO($strConnection, 'root', '1234'); // Ensure these details are correct and secure
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES utf8"); // Manually set character encoding
        } catch (PDOException $e) {
            die('Error connecting to the database: ' . $e->getMessage());
        }
    }

    public function getTabDataFromSql($squery, $parameters = [])
    {
        $sth = $this->pdo->prepare($squery);
        $sth->execute($parameters);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registerUser($username, $password, $email, $role, $status)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $sth = $this->pdo->prepare("INSERT INTO users (Username, Password, Email, Role, Status) VALUES (?, ?, ?, ?, ?)");
        return $sth->execute([$username, $hashedPassword, $email, $role, $status]);
    }

    public function loginUser($username, $password)
    {
        $userInfo = $this->getTabDataFromSql("SELECT * FROM users WHERE Username = ?", [$username]);
        if (!empty($userInfo) && password_verify($password, $userInfo[0]['Password'])) {
            // After a successful login, you may set session variables or perform other operations
            $_SESSION['user_id'] = $userInfo[0]['UserID']; // Example of setting a session variable, adjust the index as needed
            return true;
        }
        return false;
    }

    // Optionally, a destructor to close the database connection
    public function __destruct()
    {
        $this->pdo = null;
    }
}
