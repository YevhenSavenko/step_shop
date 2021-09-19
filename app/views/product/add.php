<?php
    use Framework\Request\Http;
?>

<div class="my-5">
    <h2 class="text-center">
        <?= $this->getData('heading') ?>
    </h2>
</div>
<div class="row justify-content-center mt-5">
    <form class="row col-md-6 needs-validation" method="POST" action="<?= Http::urlBuilder('/product/save/') ?>">
        <div class="col-md-6">
            <label for="validationCustom01" class="form-label">Код товара:</label>
            <input name="sku" type="text" class="form-control" id="validationCustom01" value="<?= isset($product) ? $product->getSku() : '' ?>" required>
            <input name="id" type="hidden" value="<?= isset($product) && null !== $product->getId() ? $product->getId() : '' ?>">
        </div>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">Кількість:</label>
            <input name="qty" type="number" class="form-control" id="validationCustom02" value="<?= isset($product) ? $product->getQty() : '' ?>" required>
        </div>
        <div class="col-md-6 mt-4">
            <label for="validationCustom03" class="form-label">Назва:</label>
            <input name="name" type="text" class="form-control" id="validationCustom03" value="<?= isset($product) ? $product->getName() : '' ?>" required>
        </div>
        <div class="col-md-6 mt-4">
            <label for="validationCustom04" class="form-label">Ціна:</label>
            <input name="price" type="number" class="form-control" id="validationCustom04" step="0.01" value="<?= isset($product) ? $product->getPrice() : '' ?>" required>
        </div>
        <div class="col-md-12 mt-4">
            <label for="validationCustom05" class="form-label">Опис:</label>
            <textarea name="description" type="text" class="form-control" id="validationCustom05" rows="5" required><?= isset($product) && $product->getDescription() !== '' ? htmlspecialchars_decode($product->getDescription()) : '' ?></textarea>
        </div>
        <div class="col-12 text-center mt-5">
            <input name="edited" type="submit" class="btn-submit btn btn-dark col-md-6 py-2" value="<?= $this->getData('btn') ?>">
        </div>
    </form>
</div>