<?php

use Core\Helper;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase">
        <?php foreach ($this->get('menuCollection') as $item) : ?>
          <li class="navigate-link nav-item nav-link">
            <?= \Core\Url::getLink($item['path'], $item['name']); ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <ul class="me-5 navbar-nav  navbar-right">
        <li class="nav-item me-3 menu-basket">
          <a class="nav-link" href="<?php echo $this->getBP(); ?>/basket/list/">
            <i class="bi bi-cart pe-2 image-basket">
              <span> <?= isset($_SESSION['products']['basket']['id']) ? array_sum($_SESSION['products']['basket']['id']) : 0 ?></span>
            </i>
            Кошик: <?= isset($_SESSION['products']['basket']['total']) ? $_SESSION['products']['basket']['total'] : 0 ?> ₴
          </a>
        </li>
      </ul>

      <?php $user = Helper::getCustomer() ?>
      <!-- <?php var_dump($user) ?> -->
      <?php if ($user) : ?>
        <ul class="navbar-nav  navbar-right">
          <li class="nav-item me-3"><a class="nav-link"><i class="bi bi-person-fill pe-2"></i><?= $user['last_name'] . ' ' . $user['first_name'] ?></a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $this->getBP(); ?>/customer/logout/"><i class="bi bi-door-open-fill pe-2"></i>Вийти</a></li>
        </ul>
      <?php else : ?>
        <ul class="navbar-nav  navbar-right">
          <li class="nav-item me-3"><a class="nav-link" href="<?php echo $this->getBP(); ?>/customer/register/"><i class="bi bi-person-fill pe-2"></i>Реєстрація</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $this->getBP(); ?>/customer/login/"><i class="bi bi-door-closed-fill pe-2"></i>Ввійти</a></li>
        </ul>
      <?php endif ?>
    </div>
  </div>
</nav>