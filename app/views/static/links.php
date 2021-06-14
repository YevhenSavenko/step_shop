<?php use Core\Helper; ?>
<?php if (Helper::getCustomer()) : ?>
    <div class="basket__nav">
        <div class="wrapper__links-basket">
            <div class="basket__link">
                <?= \Core\Url::getLink('/order/list', 'Всі замовлення'); ?>
            </div>
            <div class="order__link">
                <?= \Core\Url::getLink('/basket/list', 'Моя корзина'); ?>
            </div>
        </div>
    </div>
<?php endif ?>