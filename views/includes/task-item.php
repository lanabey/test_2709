<div class="task-item row">
    <?php if ($isAdmin == 1) { ?>
        <div class="task-item__id" data-id="<?=$item['id'];?>"></div>
    <?php } ?>

    <div class="task-item__user col-12 col-sm-4"><?=$item['username'];?></div>
    <div class="task-item__email col-12 col-sm-4"><?=$item['email'];?></div>
    <div class="task-item__status col-12 col-sm-4"><?php echo $item['status'] == 1 ? 'Выполнено' : 'В работе';?></div>

    <?php if ($isAdmin == 1) { ?>
        <span class="task-item__button edit-button" type="button">Редактировать</span>
    <?php } ?>
    <?php if ($isAdmin == 1 && $item['status'] == 0) { ?>
        <a class="task-item__button" href="main?edit=<?=$item['id'];?>">Выполнить</a>
    <?php } ?>
    <?php if ($isAdmin == 1 && $item['edited'] == 1) { ?>
        <div class="task-item__edited col-12 col-sm-6" href="main?edit=<?=$item['id'];?>">Отредактировано администратором</div>
    <?php } ?>

    <div class="task-item__text col-sm-12"><?=$item['text'];?></div>
</div>
