<?php use Core\View; ?>
<?php require_once View::getViewDir() . \DS . 'static' . \DS . 'links.php'; ?>

<?php $orders = $this->get('orders') ?>
<?php if ($orders) : ?>
    <div class="orders__about">
        <div class="orders__title">
            <h2 class="text-center text-uppercase fw-bolder my-5">
                Ваші замовлення
            </h2>
        </div>

        <div class="orders__body">
            <?php foreach ($this->get('orders') as $key => $value) : ?>
                <div class="orders__id">
                    Замовлення №<?= $value['info']['id'] ?>
                </div>
                <div class="orders__item">
                    <div class="cart__titles-table orders__titles-table">
                        <div class="cart__item-wrapper">
                            Товари
                        </div>
                        <div class="cart__inputs cart__align">
                            Кількість
                        </div>
                        <div class="cart__price">
                            Ціна
                        </div>
                        <div class="cart__total">
                            Сума
                        </div>
                    </div>
                    <?php foreach ($value['info']['products'] as $product) : ?>
                        <div class="cart__item orders__points">
                            <div class="cart__item-wrapper">
                                <div class="cart__empty-img">
                                    empty image
                                </div>
                                <div class="cart__info-product">
                                    <div class="cart__info-sku">
                                        <?= $product['sku'] ?>
                                    </div>
                                    <div class="cart__info-title">
                                        <?= $product['name'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="cart__inputs text-center orders__qty">
                                <span><?= $product['qty_order'] ?></span>
                            </div>
                            <div class="cart__price text-center">
                                <?= $product['price'] ?>₴
                            </div>
                            <div class="cart__total text-center">
                                <?= $product['price'] * $product['qty_order'] ?> ₴
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div class="orders__info">
                        <div class="orders__data">
                            Час замовлення: <?= $value['info']['date'] ?>
                        </div>
                        <div class="orders__data">
                            Сума замовлення: <?= $value['info']['total'] ?> ₴
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php else : ?>
    <div class="no__orders">
        Ви поки що не замовляли нічого в нашому магазині!
    </div>
<?php endif ?>