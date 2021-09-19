<?php

$product = $this->getData('product');

?>

<?php if (null !== $product): ?>
    <?php require_once __DIR__ . '/add.php'; ?>
<?php else: ?>
    <div class="row text-center my-5 fs-1 fw-normal">
        <div>
            Tакого овару не існує
        </div>
    </div>
<?php endif ?>
