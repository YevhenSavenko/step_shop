<div class="order">
    <div class="order_text">
        Замовлення <b>№<?= $this->get('orderId') ?></b> на суму <b><?= $this->get('total') ?>$</b> було оформлено, очікуйте дзвінка від менеджера
    </div>

    <div class="row justify-content-center text-center go-home">
        <div class="col-md-5">
            <?= \Core\Url::getLink('/index/index', 'Повернутись на головну') ?>
        </div>
    </div>
</div>