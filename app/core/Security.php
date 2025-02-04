<?php

namespace App\core;

class Security
{
    public static function sanitizeXSS($input)
    {
        return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public static function generateCSRFToken()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;

        return $token;
    }

    public static function validateCSRFToken($token)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
            unset($_SESSION['csrf_token']);
            return true;
        }

        return false;
    }

   

    public static function preventSQLInjection($pdo, $sql, $params = [])
    {
        $stmt = $pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt;
    }

    public static function sanitizeArrayXSS($inputs)
    {
        $sanitized = [];
        foreach ($inputs as $key => $value) {
            $sanitized[$key] = self::sanitizeXSS($value);
        }
        return $sanitized;
    }

    public static function generateRandomString($length = 32)
    {
        return bin2hex(random_bytes($length));
    }
}