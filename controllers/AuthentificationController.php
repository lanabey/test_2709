<?php

    require_once './controllers/Controller.php';

    class AuthentificationController extends Controller {

        public static $users;

        public static function renderPage() {
            session_start();

            $attempt = $success = $loggedin = $loggedout = false;
            $username = '';

            if (isset($_GET['success'])) {
                $attempt = true;

                if ($_GET['success'] == 'true') {
                    $success = true;
                } else {
                    $success = false;
                }
            }

            if (isset($_GET['signout'])) {
                $_SESSION = array();
                session_destroy();
                $loggedout = true;
            }

            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
                $loggedin = true;

                if (isset($_SESSION["username"])) {
                    $username = htmlspecialchars($_SESSION["username"]);
                }
            } else {
                $loggedin = false;
            }

            $pageContent = self::renderTemplate('views/nodes/authentification.php',
                [
                    'attempt' => $attempt,
                    'success' => $success,
                    'loggedin' => $loggedin,
                    'loggedout' => $loggedout,
                    'username' => $username,
                ]);

            $layoutContent = self::renderTemplate('views/layouts/layout.php',
                [
                    'content' => $pageContent,
                    'title' => 'Sign in',
                    'loggedin' => $loggedin,
                    'js' => false,
                ]);

            print($layoutContent);
        }

        public static function handlePost() {

            $username = $_POST['login'];
            $password = $_POST['password'];

            $user = self::$users->signIn($username);

            if (!empty($user)) {
                if ($user["password"] == $password) {
                    session_start();

                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $user["id"];
                    $_SESSION["username"] = $user["username"];

                    header("location: sign-in?success=true");
                    exit;
                }
            }

            header("location: sign-in?success=false");
            exit;
        }
    }
