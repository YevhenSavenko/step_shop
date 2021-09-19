<?php

$orders = $this->getData('orders');
$login = $this->getData('login');

?>

<?php if ($login !== 'no'): ?>
    <?php if (count($orders) > 0) : ?>
        <div class="orders__about">
            <div class="orders__title">
                <h2 class="text-center text-uppercase fw-bolder my-5">
                    Ваші замовлення
                </h2>
            </div>

            <div class="orders__body">
                <?php foreach ($orders as $order) : ?>
                    <div class="orders__id">
                        Замовлення №<?= $order->getId() ?>
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
                        <?php foreach ($order->getProducts() as $product) : ?>
                            <div class="cart__item orders__points">
                                <div class="cart__item-wrapper">
                                    <div class="cart__empty-img">
                                        empty image
                                    </div>
                                    <div class="cart__info-product">
                                        <div class="cart__info-sku">
                                            <?= $product->getSku() ?>
                                        </div>
                                        <div class="cart__info-title">
                                            <?= $product->getName() ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart__inputs text-center orders__qty">
                                    <span><?= $product->getQty() ?></span>
                                </div>
                                <div class="cart__price text-center">
                                    <?= $product->getPrice() ?>₴
                                </div>
                                <div class="cart__total text-center">
                                    <?= $product->getPrice() * $product->getQty() ?> ₴
                                </div>
                            </div>
                        <?php endforeach ?>
                        <div class="orders__info">
                            <div class="orders__data">
                                Час замовлення: <?= $order->getDate() ?>
                            </div>
                            <div class="orders__data">
                                Сума замовлення: <?= $order->getTotal() ?> ₴
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
<?php else: ?>
    <div class="no__orders">
        Авторизуйтесь - щоб подивитися Ваші замовлення
    </div>
<?php endif ?>

