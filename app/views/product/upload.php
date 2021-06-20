<?php use Core\View; ?>
<?php require_once View::getViewDir() . \DS . 'static' . \DS . 'status.php'; ?>

<?php if($this->get('danger')) : ?>
    <div class="row justify-content-center">
        <div class="product__problem col-md-6"><?= $this->get('danger') ?></div>
    </div>
<?php endif ?>

<form enctype="multipart/form-data" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="input__wrapper">
        <input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
        <input name="userfile" type="file" name="file" id="input__file" class="input input__file">
        <label for="input__file" class="input__file-button">
            <span class="input__file-icon-wrapper"><i class="bi bi-upload"></i></span>
            <span class="input__file-button-text">Виберіть файл</span>
        </label>

        <input name="send-file" type="submit" value="Імпортувати файл" class="input__file-submit" />
    </div>
</form>