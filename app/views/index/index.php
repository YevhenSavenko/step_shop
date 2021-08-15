<?php use Core\Helper; ?>

<div class="row text-center my-5">
    <?php $user = Helper::getCustomer() ?>
    <?php if ($user) : ?>
        <h3>Привіт, <?= $user['first_name'] ?>!</h3>
    <?php else : ?>
        <div>
            <h3>Привіт, користувач!</h3>
        </div>
    <?php endif ?>
</div>