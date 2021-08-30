<?php
use Framework\Request\Http;

$minRangeForInput = $this->getData('minRange');
$maxRangeForInput = $this->getData('maxRange');
$sortPrice = $this->getData('sortPrice');
$sortQty = $this->getData('sortQty');
$minSavedPrice = $this->getData('min');
$maxSavedPrice = $this->getData('max');
?>


<form class="my-4" method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-select" name='sortfirst'>
                        <option <?= $sortPrice === 'asc' ? 'selected' : '' ?> value="price_ASC">від дешевших до дорожчих</option>
                        <option <?= $sortPrice === 'desc' ? 'selected' : '' ?> value="price_DESC">від дорожчих до дешевших</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select" name='sortsecond'>
                        <option <?= $sortQty === 'asc' ? 'selected' : '' ?> value="qty_ASC">по зростанню кількості</option>
                        <option <?= $sortQty === 'desc' ? 'selected' : ''; ?> value="qty_DESC">по спаданню кількості</option>
                    </select>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <input name="min-price" type="text" class="form-control min_input" value="<?= $minSavedPrice ?> ">
                </div>
                <div class="col">
                    <input name="max-price" type="text" class="form-control max_input" value="<?= $maxSavedPrice ?>">
                </div>
            </div>
        </div>
        <input name="sortproduct" class="btn-submit btn btn-dark col-md-3" type="submit" value="Сортувати">
    </div>
</form>


<div class="middle col-md-6">
    <div class="multi-range-slider">
        <input type="range" id="input-left" min="0" max="100" value="<?= $minRangeForInput ?>">
        <input type="range" id="input-right" min="0" max="100" value="<?= $maxRangeForInput ?>">
        <div class="slider">
            <div class="track"></div>
            <div class="range"></div>
            <div class="thumb left"></div>
            <div class="thumb right"></div>
        </div>
    </div>
</div>

<?php //if (Helper::isAdmin()) : ?>
<!--    <div class="product">-->
<!--        <p class="text-center my-3 row justify-content-around">-->
<!--            <span class="btn-add col-md-3 me-5">-->
<!--                --><?//= \Core\Url::getLink('/product/add', 'Додати товар +'); ?>
<!--            </span>-->
<!--            <span class="btn-add col-md-3">-->
<!--                --><?//= \Core\Url::getLink('/order/all', 'Переглянути замовлення'); ?>
<!--            </span>-->
<!--        </p>-->
<!--    </div>-->
<?php //endif ?>

<?php $products = $this->getData('products') ?>
<?php if ($products) : ?>
    <div class="catalog">
        <div>
            <h2 class="catalog__title">Каталог</h2>
        </div>
        <div class="catalog__product">
            <?php foreach ($products as $product) : ?>
                <div class="product__item">
                    <div class="absolute__link">
                        <a href="<?= Http::urlBuilder('/product/view', ['id' => $product->getId()]) ?>"></a>
                    </div>
                    <div class="sku">
                        Код: <?= $product->getSku() ?>
                    </div>
                    <div class="empty">
                        <div class="image">
                            Empty block
                        </div>
                    </div>
                    <div class="title">
                        <?= $product->getName() ?>
                    </div>
                    <div class="qty">
                        <?= $product->getQty() > 0 ? 'Залишилося: ' . '<b>' . (int)$product->getQty() . '</b>' : 'Нема в наявності' ?>
                    </div>
                    <div class="row__action">
                        <div class="price">
                            <?= $product->getPrice() ?> <span>₴</span>
                        </div>
                        <div class="wrapper-links row">
<!--                            --><?php //if (Helper::inBasket($product['id']) === 1) : ?>
<!--                                <div class="in-basket">-->
<!--                                    --><?//= \Core\Url::getLink('/basket/index', '<i class="bi bi-cart-check"></i>'); ?>
<!--                                </div>-->
<!--                            --><?php //else : ?>
                                <div class="no-basket">
                                    <a href="<?= Http::urlBuilder('/basket/add', ['id' => $product->getId()]) ?>">
                                        <i class="bi bi-cart-plus"></i>
                                    </a>
                                </div>
<!--                            --><?php //endif ?>
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