<?php
include "database/db.php";
include "classes/Auth.php";
include "classes/Product.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>trainWork | Главная</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
        <?php include "layout/header.php" ?>
        <div class="content d-flex flex-column gap-3 align-items-center p-5">
            <p class="fs-3 fw-bold m-0">Каталог товаров:</p>
            <div class="d-flex flex-row flex-wrap justify-content-center gap-3">
                <?php $products = Product::all($db); ?>
                <?php if(!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-item d-flex flex-column gap-2 p-4 border border-secondary rounded-4">
                        <p class="fs-6 fw-bold m-0"><?= $product["name"] ?></p>
                        <p class="fs-6 fw-bold m-0">Цена: <?= $product["price"] ?></p>
                        <a href="<?= Auth::isGuest() ? "login.php" : "./productorder.php?id=".$product["id"] ?>" class="btn btn-outline-danger">Заказать</a>
                    </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <p class="fs-5 w-100 text-center fw-bold text-white-50 m-0">Товаров нет.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
