<?php

    require_once './controllers/Controller.php';

    class TaskListController extends Controller {

        public static $tasks;
        public static $users;

        public static function renderPage() {
            if (!isset($_SESSION)) {
                session_start();
            }

            $page = isset($_GET['page']) ? $_GET['page'] : 0;
            $sortBy = isset($_GET['sort']) ? $_GET['sort'] : '';
            $isDesc = isset($_GET['desc']) ? true : false;
            $completeId = isset($_GET['edit']) ? $_GET['edit'] : -1;
            $noPermission = isset($_GET['permission']) && $_GET['permission'] == 'denied' ? true : false;

            $isAdmin = $loggedin = false;
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
                $loggedin = true;
                $isAdmin = self::$users->isAdmin($_SESSION["id"]);

                if ($completeId != -1) {
                    self::$tasks->completeTask($completeId);
                }
            }

            $queryResult = self::$tasks->getTasks($page * 3, 3, $sortBy, $isDesc);
            foreach ($queryResult as $index => $item) {
                foreach ($item as $key => $value) {
                    $queryResult[$index][$key] = htmlspecialchars($value);
                }
            }

            $lastPage = intdiv(self::$tasks->getTaskAmount() - 1, 3);

            $pageContent = self::renderTemplate('views/nodes/main.php',
                [
                    'tasks' => $queryResult,
                    'page' => $page,
                    'sortBy' => $sortBy,
                    'desc' => $isDesc,
                    'lastPage' => $lastPage,
                    'isAdmin' => $isAdmin,
                    'noPermission' => $noPermission,
                ]);

            $layoutContent = self::renderTemplate('views/layouts/layout.php',
                [
                    'content' => $pageContent,
                    'title' => 'ToDo list',
                    'loggedin' => $loggedin,
                    'js' => true,
                ]);

            print($layoutContent);
        }

        public static function handlePost() {

            if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['text'])) {
                self::$tasks->addTask($_POST['username'], $_POST['email'], $_POST['text']);
            } else if (isset($_POST['id']) && isset($_POST['text'])) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
                    $isAdmin = self::$users->isAdmin($_SESSION["id"]);

                    if ($isAdmin == 1) {
                        self::$tasks->updateTask($_POST['id'], $_POST['text']);
                    } else {
                        header('Location: main?permission=denied');
                        exit;
                    }
                } else {
                    header('Location: main?permission=denied');
                    exit;
                }
            }

            header('Location: main');
            exit;
        }
    }
