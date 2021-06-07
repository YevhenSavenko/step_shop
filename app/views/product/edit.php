<?php 
    use Core\Route;
    use Core\View;
?>

<?php require_once View::getViewDir() . \DS . 'static' . \DS . 'status.php'; ?>

<?php if ($this->get('saved')) : ?>
    <?php $product = $this->get('product') ?>
    <?php require_once View::getViewDir() . \DS . Route::getController() . \DS . 'add.php' ?>
<?php else : ?>
    <?php if ($this->get('id')) : ?>
        <div class="row text-center my-5 fs-1 fw-normal">
            <div>
                Tовару з <b>id = <?= $this->get('id') ?></b> не існує
            </div>
        </div>
    <?php else : ?>
        <div class="row text-center my-5 fs-1 fw-bolder">
            <div>
                Товар не вибрано
            </div>
        </div>
    <?php endif ?>
<?php endif ?>