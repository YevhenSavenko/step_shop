<?php

use Framework\Request\Http;

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase">
                <?php foreach ($this->getData('menuCollection') as $item) : ?>
                    <li class="navigate-link nav-item nav-link">
                        <?= Http::getLink($item->getPath(), $item->getName()) ?>
                    </li>
                <?php endforeach ?>
            </ul>

            <ul class="me-5 navbar-nav  navbar-right">
                <li class="nav-item me-3 menu-basket">
                    <a class="nav-link" href="/basket/list/">
                        <i class="bi bi-cart pe-2 image-basket"></i>
                        Кошик: 0 ₴
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav  navbar-right">
                <li class="nav-item me-3">
                    <a class="nav-link" href="/customer/register/">
                        <i class="bi bi-person-fill pe-2"></i>
                        Реєстрація
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/customer/login/">
                        <i class="bi bi-door-closed-fill pe-2"></i>
                        Ввійти
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>