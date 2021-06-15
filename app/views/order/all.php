<?php $orders = $this->get('orders') ?>
<?php if ($orders) : ?>
    <div class="orders__about">
        <div class="orders__title">
            <h2 class="text-center text-uppercase fw-bolder my-5">
                Всі замовлення
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
                    <div class="person__info">
                        <div class="person__name info__about">
                            <div class="left__info">
                                Прізвище та ім'я:
                            </div>
                            <div class="right__info">
                                <?= $value['info']['first_name'] . ' ' .  $value['info']['last_name'] ?>
                            </div>
                        </div>
                        <div class="person__phone info__about">
                            <div class="left__info">
                                Номер телефону:
                            </div>
                            <div class="right__info info__about">
                                <?= $value['info']['telephone'] ?>
                            </div>
                        </div>
                        <div class="person__email info__about">
                            <div class="left__info">
                                Email:
                            </div>
                            <div class="right__info info__about">
                                <?= $value['info']['email'] ?>
                            </div>
                        </div>
                        <div class="person__address info__about">
                            <div class="left__info">
                                Адреса доставки:
                            </div>
                            <div class="right__info">
                                <?= $value['info']['address'] ?>
                            </div>
                        </div>
                    </div>
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
        Замовлень не було
    </div>
<?php endif ?>