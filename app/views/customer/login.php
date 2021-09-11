<div class="my-5">
    <h2 class="text-center text-uppercase fw-bolder">
        <?= $this->getData('title') ?>
    </h2>
</div>

<div class="login row justify-content-center mt-5">
    <form class="col-md-4" action=<?= \Framework\Request\Http::urlBuilder('/customer/authorization/') ?> method="POST" enctype="application/x-www-form-urlencoded">
        <div class="col-md-12 my-4">
            <input name="email" type="email" class="form-control input__register" placeholder="Емейл">
        </div>
        <div class="col-md-12">
            <input name="password" type="password" class="form-control input__register" placeholder="Пароль">
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                <input name="sign-in" type="submit" class="btn btn-dark col-md-12 btn__submit" value="Ввійти">
            </div>
        </div>
    </form>
</div>