<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $this->getData('title')?></title>
        <?php foreach (\Framework\Settings\Layout\Config::getLinks() as $link): ?>
            <?= $link ?>
        <?php endforeach; ?>
    </head>
    <body>
        <div class="header-shop">
            <div class="container text-center">
                <h1 class="fw-bold">Test Shop</h1>
            </div>
        </div>
        <div id="header" class="pb-4">
            <?php require_once $this->getData('menu'); ?>
        </div>
        <div class="container">
            <?php require_once $this->getData('status') ?>
            <?php require_once $this->getData('template'); ?>
        </div>

        <hr style="margin:50px 5px;background-color: black;height: 1px;">
        <footer class="container-fluid text-center">
            <p>Test Shop Copyright</p>
        </footer>

        <?php foreach (\Framework\Settings\Layout\Config::getScripts() as $script): ?>
            <?= $script ?>
        <?php endforeach; ?>
    </body>
</html>