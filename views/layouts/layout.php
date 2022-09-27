<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="src/css/style.css">
</head>
<body>
    <header class="header">
        <div class="header__container container">
            <h1 class="">ToDo List</h1>
            <div class="">
                <a href="main">Home</a>
                <?php if ($loggedin) { ?>
                    <a href="sign-in?signout=true">Выйти</a>
                <?php } else { ?>
                    <a href="sign-in">Войти</a>
                <?php } ?>
            </div>
        </div>
    </header>
    <div class="main-content">
        <main class="container"><?= $content; ?></main>
    </div>
    <footer class="footer">
        <div class="container">
            <span>Ⓒ ToDo List</span>
        </div>
    </footer>

    <script type="text/javascript" src="./src/js/script.js"></script>
</body>
</html>
