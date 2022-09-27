<div class="column">
    <h2>Sign in</h2>

    <?php
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>

    <?php
        if ($loggedin) {
    ?>

        <div class="user-info">
            <span class="user-info__text">
                Пользователь
            </span>
            <span class="user-info__text user-info__text--last">
                <?=$username;?>
            </span>
            <a class="btn btn-primary" href="sign-in?signout=true">Выйти</a>
        </div>

    <?php
        } else {
    ?>

        <form action="sign-in" method="post">
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="login" class="form-control" value="" required>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" class="form-control" value="" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Войти</button>
            </div>
        </form>

    <?php
        }
    ?>

    <?php
        if ($attempt) {
            if ($success) {
                echo '<div class="alert alert-success">Вы успешно авторизовались!</div>';
            } else {
                echo '<div class="alert alert-danger">Неверные логин или пароль!</div>';
            }
        } else if ($loggedout) {
            echo '<div class="alert alert-info">Вы вышли из аккаунта.</div>';
        }
    ?>
</div>
