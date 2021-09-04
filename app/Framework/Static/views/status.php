<?php if (isset($_SESSION['alerts']['messages'])) : ?>
    <div class="row justify-content-center status__modal modal__show">
        <?php if (isset($_SESSION['alerts']['messages']['status'])) : ?>
            <?php switch ($_SESSION['alerts']['messages']['status']):
                case 'access': ?>
                    <div class="alert alert-success text-center col-md-5" role="alert">
                        <?= $_SESSION['alerts']['messages']['body'] ?>
                    </div>
                    <?php break;
                case 'error': ?>
                    <div class="alert alert-danger text-center col-md-5" role="alert">
                        <?= $_SESSION['alerts']['messages']['body'] ?>
                    </div>
                    <?php break;
                default: ?>
                    <?php break ?>
                <?php endswitch ?>
        <?php endif ?>
    </div>
<?php endif ?>