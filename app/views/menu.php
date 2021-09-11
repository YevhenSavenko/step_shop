<?php use Framework\Request\Http; ?>
<?php use Framework\Authorization\Session;

$session = new Session();
$customer = $session->isLogin();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase">
                <?php foreach ($this->getData('menuCollection') as $item) : ?>
                    <li class="navigate-link nav-item nav-link">
                        <a href="<?= Http::urlBuilder($item->getPath()) ?>">
                            <?= $item->getName() ?>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>

            <ul class="me-5 navbar-nav  navbar-right">
                <li class="nav-item me-3 menu-basket">
                    <a class="nav-link" href="<?= Http::urlBuilder('/basket/list/') ?>">
                        <i class="bi bi-cart pe-2 image-basket"></i>
                        Кошик: 0 ₴
                    </a>
                </li>
            </ul>
            <?php if ($customer) : ?>
                <ul class="navbar-nav  navbar-right">
                    <li class="nav-item me-3">
                        <a class="nav-link">
                            <i class="bi bi-person-fill pe-2"></i><?= $customer->getLastName() . ' ' . $customer->getFirstName() ?>
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