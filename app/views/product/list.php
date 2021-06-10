<?php

use Core\Helper;
use Core\View; ?>
<?php require_once View::getViewDir() . \DS . 'static' . \DS . 'status.php'; ?>

<form class="my-4" method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-select" name='sortfirst'>
                        <option <?= $this->get('sortPrice') === 'asc' ? 'selected' : '' ?> value="price_ASC">від дешевших до дорожчих</option>
                        <option <?= $this->get('sortPrice') === 'desc' ? 'selected' : '' ?> value="price_DESC">від дорожчих до дешевших</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select" name='sortsecond'>
                        <option <?= $this->get('sortQty') === 'asc' ? 'selected' : '' ?> value="qty_ASC">по зростанню кількості</option>
                        <option <?= $this->get('sortQty') === 'desc' ? 'selected' : ''; ?> value="qty_DESC">по спаданню кількості</option>
                    </select>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <input name="min-price" type="text" class="form-control min_input" value="0">
                </div>
                <div class="col">
                    <input name="max-price" type="text" class="form-control max_input" value="<?= (float)$this->get('maxPrice') ?>">
                </div>
            </div>
        </div>
        <input name="sortproduct" class="btn-submit btn btn-dark col-md-3" type="submit" value="Сортувати">
    </div>
</form>


<div class="middle col-md-6">
    <div class="multi-range-slider">
        <input type="range" id="input-left" min="0" max="100" value="0">
        <input type="range" id="input-right" min="0" max="100" value="100">

        <div class="slider">
            <div class="track"></div>
            <div class="range"></div>
            <div class="thumb left"></div>
            <div class="thumb right"></div>
        </div>
    </div>
</div>

<div class="product">
    <p class="text-center my-3 row justify-content-center">
        <span class="btn-add col-md-3">
            <?= \Core\Url::getLink('/product/add', 'Додати товар +'); ?>
        </span>
    </p>
</div>

<?php $products =  $this->get('products') ?>

<?php if ($products) : ?>
    <!-- <?php foreach ($products as $product) : ?>
        <div class="product">
            <p class="sku">Код: <?php echo $product['sku'] ?></p>
            <h4><?php echo $product['name'] ?></h4>
            <p> Ціна: <span class="price"><?php echo $product['price'] ?></span> грн</p>
            <p> Кількість: <?php echo $product['qty'] ?></p>
            <p><?php if (!$product['qty'] > 0) {
                    echo 'Нема в наявності';
                } ?></p>

            <p class="sku"> Опис: <?= !empty($product['description']) ? htmlspecialchars_decode($product['description']) : 'Опис відсутній для даного товару' ?></p>
            <div class="wrapper-links row">
                <div class="edit-link col-md-2">
                    <?= \Core\Url::getLink('/product/edit', 'Редагувати', array('id' => $product['id'])); ?>
                </div>
                <div class="delete-link col-md-2">
                    <?= \Core\Url::getLink('/product/delete', 'Видалити', array('id' => $product['id'])); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?> -->

    <div class="catalog">
        <div>
            <h2 class="catalog__title">Каталог</h2>
        </div>
        <div class="catalog__product">
            <?php foreach ($products as $product) : ?>
                <div class="product__item">
                    <div class="absolute__link">
                        <?= \Core\Url::getLink('/product/view', '', array('id' => $product['id'])); ?>
                    </div>
                    <div class="sku">
                        Код: <?= $product['sku'] ?>
                    </div>
                    <div class="empty">
                        <div class="image">
                            Empty block
                        </div>
                    </div>
                    <div class="title">
                        <?= $product['name'] ?>
                    </div>
                    <div class="qty">
                        <?= $product['qty'] > 0 ? 'Залишилося: ' . '<b>' . (int)$product['qty'] . '</b>' : 'Нема в наявності' ?>
                    </div>
                    <div class="row__action">
                        <div class="price">
                            <?= $product['price'] ?> <span>₴</span>
                        </div>
                        <div class="wrapper-links row">
                            <?php if (Helper::inBasket($product['id']) === 1) : ?>
                                <div class="in-basket">
                                    <?= \Core\Url::getLink('/######', '<i class="bi bi-cart-check"></i>'); ?>
                                </div>
                            <?php else : ?>
                                <div class="no-basket">
                                    <?= \Core\Url::getLink('/basket/add', '<i class="bi bi-cart-plus"></i>', array('id' => $product['id'])); ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php else : ?>
    <div class="row text-center my-5 fs-1 fw-bolder">
        <div class="py-5">
            Товарів в данній ціновій категорії немає
        </div>
    </div>
<?php endif ?>