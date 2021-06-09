<div class="mt-5">
    <h4 class="text-uppercase fw-bolder text-center fs-2">
        Опис
    </h4>
</div>

<?php if ($product) : ?>

    <div class="view">
        <div class="view__product">
            <div class="empty">
                <div class="image">
                    Empty block
                </div>
            </div>
            <div class="sku-product view__descript">
                <div class="sku__label left__column">Код</div>
                <div class="right__column"><?= $product['sku'] ?></div>
            </div>
            <div class="title-product view__descript">
                <div class="name left__column">Назва</div>
                <div class="right__column"><?= $product['name'] ?></div>
            </div>
            <div class="qty-product view__descript">
                <div class="name left__column">Кількість</div>
                <div class="right__column"><?= $product['qty'] > 0 ? (int)$product['qty'] : 'Нема в наявності' ?></div>
            </div>
            <div class="price-product view__descript">
                <div class="price-product left__column">Ціна</div>
                <div class="right__column"><?= $product['price'] ?><span>₴</span></div>
            </div>
            <div class="descript">
                <div class="descript-product">Опис:</div>
                <div class="table-descript">
                    <?= !empty($product['description']) ? htmlspecialchars_decode($product['description']) : 'Опис відсутній для даного товару' ?>
                </div>
            </div>
            <div class="wrapper-view-links">
                <div class="in-view-basket">
                    <?= \Core\Url::getLink('#', 'В корзину', array('id' => $product['id'])); ?>
                </div>
                <div class="edit-link">
                    <?= \Core\Url::getLink('/product/edit', 'Редагувати', array('id' => $product['id'])); ?>
                </div>
                <div class="delete-link">
                    <?= \Core\Url::getLink('/product/delete', 'Видалити', array('id' => $product['id'])); ?>
                </div>
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