<?php

use Core\View; ?>
<?php require_once View::getViewDir() . \DS . 'static' . \DS . 'status.php'; ?>

<?php $user = $this->get('user') ?>

<div class="my-5">
    <h2 class="text-center text-uppercase fw-bolder">
        Оформити замовлення
    </h2>
</div>

<div class="register mt-5 row justify-content-center">
    <form class="row col-md-7" action="<?= $this->getBP() ?>/order/index" method="POST" enctype="application/x-www-form-urlencoded">
        <div class="col-md-6">
            <input name="last_name" type="text" class="form-control input__register" placeholder="Прізвище" value="<?= $user['last_name'] ?? '' ?>">
        </div>
        <div class=" col-md-6">
            <input name="first_name" type="text" class="form-control input__register" placeholder="Ім'я" value="<?= $user['first_name'] ?? '' ?>">
        </div>
        <div class="col-md-6 my-4">
            <input name="telephone" type="tel" class="form-control input__register" placeholder="Мобільний номер" value="<?= $user['telephone'] ?? '' ?>">
        </div>
        <div class="col-md-6 my-4">
            <input name="email" type="email" class="form-control input__register" placeholder="Емейл" value="<?= $user['email'] ?? '' ?>">
        </div>
        <div class="row justify-content-center mb-5 pe-0">
            <div class="col-md-12 pe-0">
                <textarea name="address" type="text" class="form-control input__register" rows="3" placeholder="Адрес доставки"><?= $user['address'] ?? '' ?></textarea>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <input name="order" type="submit" class="btn btn-dark col-md-12 btn__submit" value="Оформити">
            </div>
        </div>
    </form>
</div>