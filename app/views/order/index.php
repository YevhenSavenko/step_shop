<?php

use Framework\Request\Http;
$customerInfo = $this->getData('customer_info');

?>

<div class="my-5">
    <h2 class="text-center text-uppercase fw-bolder">
        Оформити замовлення
    </h2>
</div>

<div class="register mt-5 row justify-content-center">
    <form class="row col-md-7" action="<?= Http::urlBuilder('/order/arrange/') ?>" method="POST"
          enctype="application/x-www-form-urlencoded">
        <div class="col-md-6">
            <input name="last_name" type="text" class="form-control input__register" placeholder="Прізвище"
                   value="<?= $customerInfo !== null ? $customerInfo->getLastName() : '' ?>">
        </div>
        <div class=" col-md-6">
            <input name="first_name" type="text" class="form-control input__register" placeholder="Ім'я"
                   value="<?= $customerInfo !== null ? $customerInfo->getFirstName() : '' ?>">
        </div>
        <div class="col-md-6 my-4">
            <input name="telephone" type="tel" class="form-control input__register" placeholder="Мобільний номер"
                   value="<?= $customerInfo !== null ? $customerInfo->getTelephone() : '' ?>">
        </div>
        <div class="col-md-6 my-4">
            <input name="email" type="email" class="form-control input__register" placeholder="Емейл"
                   value="<?= $customerInfo !== null ? $customerInfo->getEmail() : '' ?>">
        </div>
        <div class="row justify-content-center mb-5 pe-0">
            <div class="col-md-12 pe-0">
                <textarea name="address" type="text" class="form-control input__register" rows="3"
                          placeholder="Адрес доставки"><?= $customerInfo !== null ? $customerInfo->getAddress() : '' ?></textarea>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <input name="order" type="submit" class="btn btn-dark col-md-12 btn__submit" value="Оформити">
            </div>
        </div>
    </form>
</div>