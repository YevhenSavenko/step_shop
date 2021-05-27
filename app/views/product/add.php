<div class="my-5">
    <h2 class="text-center">
        <?= $this->get('headding') ?>
    </h2>
</div>
<div class="row justify-content-center mt-5">
    <form class="row col-md-6 needs-validation" method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
        <div class="col-md-6">
            <label for="validationCustom01" class="form-label">Код товара:</label>
            <input name="sku" type="text" class="form-control" id="validationCustom01" value="<?= $product['sku'] ?? '' ?>" required>
        </div>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">Кількість:</label>
            <input name="qty" type="number" class="form-control" id="validationCustom02" value="<?= (int)$product['qty'] ?? '' ?>" required>
        </div>
        <div class="col-md-6 mt-4">
            <label for="validationCustom03" class="form-label">Назва:</label>
            <input name="name" type="text" class="form-control" id="validationCustom03" value="<?= $product['name'] ?? '' ?>" required>
        </div>
        <div class="col-md-6 mt-4">
            <label for="validationCustom04" class="form-label">Ціна:</label>
            <input name="price" type="number" class="form-control" id="validationCustom04" step="0.01" value="<?= $product['price'] ?? '' ?>" required>
        </div>

        <div class="col-12 text-center mt-5">
            <input name="edited" type="submit" class="btn-submit btn btn-dark col-md-6 py-2" value="<?= $this->get('btn') ?>">
        </div>
    </form>

</div>