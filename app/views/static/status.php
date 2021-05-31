<?php if (isset($_GET['status'])) : ?>
    <div class="row justify-content-center status__modal modal__show">
        <?php switch ($_GET['status']):
            case 'ok_edit': ?>
                <div class="alert alert-success text-center col-md-5" role="alert">
                    Редагування успішне
                </div>
            <?php break;
            case 'ok_add': ?>
                <div class="alert alert-success text-center col-md-5" role="alert">
                    Додавання успішне
                </div>
            <?php break;
            case 'ok_delete': ?>
                <div class="alert alert-success text-center col-md-5" role="alert">
                    Видалення успішне
                </div>
            <?php break;
            case 'no_delete': ?>
                <div class="alert alert-danger text-center col-md-5" role="alert">
                    Такого товару не існує
                </div>
            <?php break;
            default: ?>
                <?php break ?>
        <?php endswitch ?>
    </div>
<?php endif ?>