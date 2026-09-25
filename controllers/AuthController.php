<?php

class AuthController extends Controller
{
    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $this->verifyCsrf();

            $firstName = trim($_POST["first_name"] ?? "");
            $lastName = trim($_POST["last_name"] ?? "");
            $email = trim($_POST["email"] ?? "");
            $password = $_POST["password"] ?? "";
            $location = trim($_POST["location"] ?? "");
            $description = trim($_POST["description"] ?? "");
            $occupation = trim($_POST["occupation"] ?? "");

            $errors = [];

            if ($firstName === "") {
                $errors[] = "First name is required.";
            }

            if ($lastName === "") {
                $errors[] = "Last name is required.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Please enter a valid email.";
            }

            if (strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters.";
            }

            if (!empty($errors)) {

                $this->view("register", [
                    "errors" => $errors,
                    "csrf_token" => $this->csrfToken()
                ]);

                return;
            }

            $user = new User();

            $existingUser = $user->findByEmail($email);

            if ($existingUser) {

                $this->view("register", [
                    "errors" => [
                        "This email is already registered."
                    ],
                    "csrf_token" => $this->csrfToken()
                ]);

                return;
            }

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $created = $user->create(
                $firstName,
                $lastName,
                $email,
                $hashedPassword,
                $location,
                $description,
                $occupation
            );

            if ($created) {

                header("Location: /alzikrayat/login");
                exit;

            } else {

                $this->view("register", [
                    "errors" => [
                        "Registration failed."
                    ],
                    "csrf_token" => $this->csrfToken()
                ]);
            }

        } else {

            $this->view("register", [
                "csrf_token" => $this->csrfToken()
            ]);
        }
    }


    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $this->verifyCsrf();

            $email = trim($_POST["email"] ?? "");
            $password = $_POST["password"] ?? "";

            $errors = [];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Please enter a valid email.";
            }

            if ($password === "") {
                $errors[] = "Password is required.";
            }

            if (!empty($errors)) {

                $this->view("login", [
                    "errors" => $errors,
                    "csrf_token" => $this->csrfToken()
                ]);

                return;
            }

            $user = new User();

            $existingUser = $user->findByEmail($email);

            if (
                !$existingUser ||
                !password_verify(
                    $password,
                    $existingUser["password"]
                )
            ) {

                $this->view("login", [
                    "errors" => [
                        "Invalid email or password."
                    ],
                    "csrf_token" => $this->csrfToken()
                ]);

                return;
            }

            session_start();

            session_regenerate_id(true);

            $_SESSION["user_id"] = $existingUser["id"];

            $_SESSION["user_name"] =
                $existingUser["first_name"] . " " .
                $existingUser["last_name"];

            $_SESSION["first_name"] =
                $existingUser["first_name"];


            

            $lastLogin = $_COOKIE["last_login"] ?? null;


            

            setcookie(
                "last_login",
                date("Y-m-d H:i:s"),
                time() + (7 * 24 * 60 * 60),
                "/"
            );


            $_SESSION["previous_last_login"] = $lastLogin;


            header("Location: /alzikrayat/");

            exit;
        }


        $lastLogin = $_COOKIE["last_login"] ?? null;

        $this->view("login", [
            "csrf_token" => $this->csrfToken(),
            "last_login" => $lastLogin
        ]);
    }


    public function logout()
    {
        session_start();

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                "",
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        header("Location: /alzikrayat/login");

        exit;
    }
}