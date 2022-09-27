<div class="row">
    <div class="column col-12 col-lg-8">
        <h2>Список задач</h2>

        <div class="task-list">
            <div class="task-list__header row">
                <a class="task-list__sort col-sm-4" href="<?php echo $sortBy == 'username' ? ($desc ? 'main' : 'main?sort=username&desc=true') : 'main?sort=username' ?>">Пользователь</a>
                <a class="task-list__sort col-sm-4" href="<?php echo $sortBy == 'email' ? ($desc ? 'main' : 'main?sort=email&desc=true') : 'main?sort=email' ?>">Email</a>
                <a class="task-list__sort col-sm-4" href="<?php echo $sortBy == 'status' ? ($desc ? 'main' : 'main?sort=status&desc=true') : 'main?sort=status' ?>">Статус</a>
            </div>

            <?php foreach ($tasks as $item): ?>
                <?=Controller::renderTemplate('views/includes/task-item.php', ['item' => $item, 'isAdmin' => $isAdmin,]);?>
            <?php endforeach; ?>

            <div class="task-list__footer">
                <?php
                    if ($page > 0) {
                        $prevPage = $page - 1;
                ?>
                    <a class="task-list__footer--link" href="<?php echo $sortBy != '' ? ($desc ? "main?page=$prevPage&sort=$sortBy&desc=true" : "main?page=$prevPage&sort=$sortBy") : "main?page=$prevPage" ?>">Назад</a>
                <?php
                    }
                    if ($page < $lastPage) {
                        $nextPage = $page + 1;
                ?>
                    <a class="task-list__footer--link task-list__footer--last" href="<?php echo $sortBy != '' ? ($desc ? "main?page=$nextPage&sort=$sortBy&desc=true" : "main?page=$nextPage&sort=$sortBy") : "main?page=$nextPage" ?>">Дальше</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="column col-12 col-lg-4">
        <div class="creation-form">
            <h2>Добавить новую задачу</h2>

            <form class="task-form" action="main" method="post">
                <input class="form-control" type="text" name="username" value="" placeholder="Username" required>
                <input class="form-control" type="email" name="email" value="" placeholder="Email" required>
                <textarea class="form-control" name="text" rows="4" required></textarea>
                <button class="btn btn-primary" type="submit" name="button">Добавить задачу</button>
            </form>
        </div>

        <?php
            if ($noPermission) {
                echo '<div class="alert alert-danger">Для редактирования задачи необходима авторизация!</div>';
            }
        ?>

        <?php if ($isAdmin == 1) { ?>
            <div class="editing-form hidden">
                <h2>Редактировать задачу</h2>

                <form class="task-form" action="main" method="post">
                    <input class="task-form__hidden" type="text" name="id" value="">
                    <textarea class="form-control" name="text" rows="4" required></textarea>
                    <button class="btn btn-primary" type="submit" name="confirm-edit">Изменить задачу</button>
                    <button class="btn btn-primary" type="button" name="cancel">Отмена</button>
                </form>
            </div>
        <?php } ?>

    </div>
</div>
