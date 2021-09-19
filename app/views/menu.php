<?php

use Framework\Request\Http;
use Model\Basket\Basket;

$customer = $this->session->isLogin();

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase">
                <?php foreach ($this->getData('menuCollection') as $item) : ?>
                    <li class="navigate-link nav-item nav-link">
                        <?php if(!$this->session->isAdmin()): ?>
                            <?php if($item->getIsActive() === 1): ?>
                                <a href="<?= Http::urlBuilder($item->getPath()) ?>">
                                    <?= $item->getName() ?>
                                </a>
                            <?php endif ?>
                        <?php else: ?>
                        <a href="<?= Http::urlBuilder($item->getPath()) ?>">
                            <?= $item->getName() ?>
                        </a>
                        <?php endif ?>
                <?php endforeach ?>
            </ul>
            <ul class="me-5 navbar-nav  navbar-right">
                <li class="nav-item me-3 menu-basket">
                    <a class="nav-link" href="<?= Http::urlBuilder('/basket/index/') ?>">
                        <i class="bi bi-cart pe-2 image-basket">
                            <span> <?= Basket::getTotalQty() ?></span>
                        </i>
                        Кошик: <?= Basket::getTotalSum() ?> ₴
                    </a>
                </li>
            </ul>
            <?php if ($customer) : ?>
                <ul class="navbar-nav  navbar-right">
                    <li class="nav-item me-3">
                        <a href="<?= Http::urlBuilder('/index/index')?>" class="nav-link">
                            <i class="bi bi-person-fill pe-2"></i><?= $customer->getFirstName() . ' ' . $customer->getLastName() ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Http::urlBuilder('/customer/logout/') ?>">
                            <i class="bi bi-door-open-fill pe-2"></i>
                            Вийти
                        </a>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="navbar-nav  navbar-right">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="<?= Http::urlBuilder('/customer/register/') ?>">
                            <i class="bi bi-person-fill pe-2"></i>
                            Реєстрація
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Http::urlBuilder('/customer/login/') ?>">
                            <i class="bi bi-door-closed-fill pe-2"></i>
                            Ввійти
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>