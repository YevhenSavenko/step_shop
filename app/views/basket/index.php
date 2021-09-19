<?php

use Framework\Request\Http;
$products = $this->getData('products');

?>

<?php if (count($products) > 0) : ?>
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

            <div>
                <div class="cart__items">
                    <?php foreach ($products as $product) : ?>
                        <div class="cart__item">
                            <div class="cart__item-wrapper">
                                <div class="cart__empty-img">
                                    empty image
                                </div>
                                <div class="cart__info-product">
                                    <div class="cart__info-sku">
                                        <?= $product->getSku()?>
                                    </div>
                                    <div class="cart__info-title">
                                        <?= $product->getName() ?>
                                    </div>
                                </div>
                            </div>
                            <div class="cart__inputs">
                                <div class="cart__info-quantity">
                                    <div class="cart__quantity-wrapper">
                                        <div class="cart__minus"> &mdash; </div>
                                        <input type="number" value="<?= $this->getData('infoProduct')[$product->getId()] ?>" size="5" readonly>
                                        <div class="cart__plus"> + </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart__price">
                                <span><?= $product->getPrice() ?> ₴</span>
                            </div>
                            <div class="cart__total">
                                <span><?= $this->getData('infoProduct')[$product->getId()] * $product->getPrice() ?> ₴</span>
                            </div>
                            <div class="cart__delete">
                                <a href="<?= Http::urlBuilder('/basket/delete', ['id' => $product->getId()]) ?>">
                                    <i class="bi bi-cart-x"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div class="cart__buttons">
                        <div class="cart__pay">
                            <a href="<?= Http::urlBuilder('/order/index/') ?>">
                                Оформити замовлення
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart__total-block">
            <h1 class="cart__title">Разом: </h1>
            <div class="cart__total-info">
                <div class="cart__row">
                    <span class="cart__flags">Кількість:</span> <span class="cart__output"><?= $this->getData('quantityProducts') ?></span>
                </div>
                <div class="cart__row">
                    <span class="cart__flags">Сума корзини:</span> <span class="cart__output"><?= $this->getData('totalPrice') ?> ₴</span>
                </div>
            </div>
            <div class="cart__route">
                <div class="cart__index">
                    <a href="<?= Http::urlBuilder('/product/catalog') ?>">
                        Продовжити покупки
                    </a>
                </div>
                <div class="cart__reset">
                    <a href="<?= Http::urlBuilder('/basket/clear') ?>">
                        Очистити корзину
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <h1 class="cart__title mt-5">Корзина: </h1>
    <div class="cart__empty">
        <h2>ваша корзина пуста</h2>
        <div class="cart__link-home">
            <a href="<?= Http::urlBuilder('/product/catalog') ?>">
                Перейти в каталог
            </a>
        </div>
    </div>
<?php endif ?>