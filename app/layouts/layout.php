<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->getBP(); ?>/css/style.css">
    <title><?= $this->get('title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="header-shop">
        <div class="container text-center">
            <h1 class="fw-bold">Test Shop</h1>
        </div>
    </div>

    <div id="header" class="mb-4">
        <?= $this->get('menu'); ?>
    </div>
    <div class="container">
        <?= $this->get('content'); ?>
    </div>

    <hr style="margin:50px 5px;background-color: black;height: 1px;">
    <footer class="container-fluid text-center">
        <p>Test Shop Copyright</p>
    </footer>

    <script src="<?php echo $this->getBP() ?>/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>