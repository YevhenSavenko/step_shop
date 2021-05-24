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

      <ul class="navbar-nav  navbar-right">
        <li class="nav-item me-3"><a class="nav-link" href="<?php echo $this->getBP(); ?>/customer/register/"><i class="bi bi-person-fill pe-2"></i>Sign Up</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo $this->getBP(); ?>/customer/login/"><i class="bi bi-box-arrow-right pe-2"></i>Login</a></li>
      </ul>

    </div>
  </div>
</nav>