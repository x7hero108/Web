<?php

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);

        require_once __DIR__ . "/../views/" . $view . ".php";
    }

    protected function requireLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["user_id"])) {
            header("Location: /alzikrayat/login");
            exit;
        }
    }

    protected function csrfToken()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION["csrf_token"])) {
            $_SESSION["csrf_token"] = bin2hex(
                random_bytes(32)
            );
        }

        return $_SESSION["csrf_token"];
    }

    protected function verifyCsrf()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = $_POST["csrf_token"] ?? "";

        if (
            empty($_SESSION["csrf_token"]) ||
            !hash_equals($_SESSION["csrf_token"], $token)
        ) {
            http_response_code(403);
            echo "Invalid CSRF token.";
            exit;
        }
    }
}