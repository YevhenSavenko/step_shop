<?php use Core\View; ?>
<?php require_once View::getViewDir() . \DS . 'static' . \DS . 'status.php'; ?>

<div class="my-5">
    <h2 class="text-center text-uppercase fw-bolder">
        <?= $this->get('title') ?>
    </h2>
</div>

<div class="register mt-5 row justify-content-center">
    <form class="row col-md-7" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" enctype="application/x-www-form-urlencoded">
        <div class="col-md-6">
            <input name="last_name" type="text" class="form-control input__register" placeholder="Прізвище">
        </div>
        <div class="col-md-6">
            <input name="first_name" type="text" class="form-control input__register" placeholder="Ім'я">
        </div>
        <div class="col-md-6 my-4">
            <input name="email" type="email" class="form-control input__register" placeholder="Емейл">
        </div>
        <div class="col-md-6 my-4">
            <input name="telephone" type="tel" class="form-control input__register" placeholder="Мобільний номер">
        </div>
        <div class="col-md-6">
            <input name="password" type="password" class="form-control input__register" placeholder="Пароль">
        </div>
        <div class="col-md-6">
            <input name="confirm_password" type="password" class="form-control input__register" placeholder="Підтвердження паролю">
        </div>
        <div class="row justify-content-center mb-5 mt-4">
            <div class="col-md-6">
                <input name="city" type="text" class="form-control input__register" placeholder="Місто">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <input name="register" type="submit" class="btn btn-dark col-md-12 btn__submit" value="Зареєструватися">
            </div>
        </div>
    </form>
</div>