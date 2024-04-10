<?php
// SessionManager.php
class SessionManager {
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function checkUserSession() {
        self::startSession();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../login/login.php');
            exit();
        }
    }
}
