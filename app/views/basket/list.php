<?php $products = $this->get('products') ?>
<?php if (!empty($products)) : ?>
    <div class="cart__group mt-5">
        <div>
            <h1 class="cart__title">Корзина </h1>
            <div class="cart__titles-table">
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

            <form action="<?= $this->getBP() ?>/order/index" method="POST">
                <div class="cart__items">
                    <?php foreach ($products as $product) : ?>

                        <div class="cart__item">
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
                            <div class="cart__inputs">
                                <!-- <div>
                                    <input type="hidden" name="p[id][<?= $product['id'] ?>]" value="<?= $this->get('infoProduct')[$product['id']] ?>">
                                </div> -->
                                <div class="cart__info-quantity">
                                    <div class="cart__quantity-wrapper">
                                        <div class="cart__minus"> &mdash; </div>
                                        <input type="number" value="<?= $this->get('infoProduct')[$product['id']] ?>" size="5" readonly>
                                        <div class="cart__plus"> + </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart__price">
                                <span><?= $product['price'] ?> ₴</span>
                            </div>
                            <div class="cart__total">
                                <span><?= $this->get('infoProduct')[$product['id']] * $product['price'] ?> ₴</span>
                            </div>
                            <div class="cart__delete">
                                <?= \Core\Url::getLink('/basket/delete', '<i class="bi bi-cart-x"></i>', array('id' => $product['id'])) ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <!-- <input name="total" type="hidden" value="<?= $this->get('totalPrice') ?>"> -->

                    <div class="cart__buttons">
                        <div class="cart__pay">
                            <input name="request" type="submit" value="Оформити замовлення">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="cart__total-block">
            <h1 class="cart__title">Разом: </h1>
            <div class="cart__total-info">
                <div class="cart__row">
                    <span class="cart__flags">Кількість:</span> <span class="cart__output"><?= $this->get('quantityProducts') ?></span>
                </div>
                <div class="cart__row">
                    <span class="cart__flags">Сума корзини:</span> <span class="cart__output"><?= $this->get('totalPrice') ?> ₴</span>
                </div>
            </div>
            <div class="cart__route">
                <div class="cart__index">
                    <?= \Core\Url::getLink('/product/list', 'Продовжити покупки') ?>
                </div>
                <div class="cart__reset">
                    <?= \Core\Url::getLink('/basket/clear', 'Очистити корзину') ?>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <h1 class="cart__title mt-5">Корзина: </h1>
    <div class="cart__empty">
        <h2>ваша корзина пуста</h2>
        <div class="cart__link-home">
            <?= \Core\Url::getLink('/product/list', 'Перейти в каталог') ?>
        </div>
    </div>
<?php endif ?>