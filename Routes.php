<?php
    require_once './routes/Route.php';
    require_once './controllers/TaskListController.php';
    require_once './models/TaskDispatcher.php';
    require_once './controllers/AuthentificationController.php';
    require_once './models/UserDispatcher.php';

    TaskListController::$tasks = new TaskDispatcher();
    TaskListController::$users = new UserDispatcher();
    AuthentificationController::$users = new UserDispatcher();

    switch($_SERVER['REQUEST_METHOD']) {
        case "POST":
            if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['text']) ||
                isset($_POST['id']) && isset($_POST['text'])) {
                TaskListController::handlePost();
            } else if (isset($_POST['login']) && isset($_POST['password'])) {
                AuthentificationController::handlePost();
            } else {
                echo 'Error!';
            }
            break;
    }

    Route::setRoute('index.php', function() {
        TaskListController::renderPage();
    });

    Route::setRoute('main', function() {
        TaskListController::renderPage();
    });

    Route::setRoute('sign-in', function() {
        AuthentificationController::renderPage();
    });
