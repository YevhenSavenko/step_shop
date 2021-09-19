<?php

use Model\Basket\Basket;
use Framework\Request\Http;

$product = $this->getData('product');
?>

    <div class="mt-5">
        <h4 class="text-uppercase fw-bolder text-center fs-2">
            Опис
        </h4>
    </div>

<?php if (null !== $product) : ?>
    <div class="view">
        <div class="view__product">
            <div class="empty">
                <div class="image">
                    Empty block
                </div>
            </div>
            <div class="sku-product view__descript">
                <div class="sku__label left__column">Код</div>
                <div class="right__column"><?= $product->getSku() ?></div>
            </div>
            <div class="title-product view__descript">
                <div class="name left__column">Назва</div>
                <div class="right__column"><?= $product->getName() ?></div>
            </div>
            <div class="qty-product view__descript">
                <div class="name left__column">Кількість</div>
                <div class="right__column"><?= $product->getQty() > 0 ? $product->getQty() : 'Нема в наявності' ?></div>
            </div>
            <div class="price-product view__descript">
                <div class="price-product left__column">Ціна</div>
                <div class="right__column"><?= $product->getPrice() ?> <span>₴</span></div>
            </div>
            <div class="descript">
                <div class="descript-product">Опис:</div>
                <div class="table-descript">
                    <?= !empty($product->getDescription()) ? htmlspecialchars_decode($product->getDescription()) : 'Опис відсутній для даного товару' ?>
                </div>
            </div>
            <div class="wrapper-view-links">
                <?php if (Basket::inBasket($product->getId())): ?>
                    <div class="in-view-basket">
                        <a href="<?= Http::urlBuilder('/basket/index/') ?>">
                            <span>В корзині</span><i class="bi bi-check2"></i>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="in-view-basket">
                        <a href="<?= Http::urlBuilder('/basket/add', ['id' => $product->getId()]) ?>">
                            В корзину
                        </a>
                    </div>
                <?php endif ?>

                <?php if ($this->session->isAdmin()): ?>
                    <div class="edit-link">
                        <a href="<?= Http::urlBuilder('/product/edit', ['id' => $product->getId()]) ?>">
                            Редагувати
                        </a>
                    </div>
                    <div class="delete-link">
                        <a href="<?= Http::urlBuilder('/product/delete', ['id' => $product->getId()]) ?>">
                            Видалити
                        </a>
                    </div>
                <?php endif ?>
            </div>

        </div>
    </div>
<?php else : ?>
    <div class="mt-5">
        <h4 class="text-uppercase fw-bolder text-center fs-5">
            Такого товару не існує
        </h4>
    </div>
<?php endif ?>