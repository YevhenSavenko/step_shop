<?php use Framework\Request\Http; ?>

<div class="order">
    <div class="order_text">
        Замовлення <b>№<?= $this->getData('orderId') ?></b> на суму <b><?= $this->getData('total') ?>$</b> було оформлено, очікуйте дзвінка від менеджера
    </div>

    <div class="row justify-content-center text-center go-home">
        <div class="col-md-5">
            <a href="<?= Http::urlBuilder('/product/catalog/') ?>">
                Повернутись до покупок
            </a>
        </div>
    </div>
</div>