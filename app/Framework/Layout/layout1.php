<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php foreach (\Settings\Layout\Config::getLinks() as $link): ?>
        <?= $link ?>
    <?php endforeach; ?>
    <!--    <title> //= $this->get('title'); </title> -->
</head>
<body>
    <div class="header-shop">
        <div class="container text-center">
            <h1 class="fw-bold">Test Shop</h1>
        </div>
    </div>

    <div id="header" class="pb-4">
        <?= require_once $this->getData('menu'); ?>
    </div>
    <div class="container">
        <!--        --><? //= $this->get('content'); ?>
    </div>

    <hr style="margin:50px 5px;background-color: black;height: 1px;">
    <footer class="container-fluid text-center">
        <p>Test Shop Copyright</p>
    </footer>

    <?php foreach (\Settings\Layout\Config::getScripts() as $script): ?>
        <?= $script ?>
    <?php endforeach; ?>
</body>

</html>