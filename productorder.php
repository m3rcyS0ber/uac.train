<?php

include "database/db.php";
include "classes/Auth.php";
include "classes/Product.php";

if(!$_GET["id"]) header("Location: index.php");

if(Auth::isGuest() || Auth::userIsAdmin($db)) header("Location: index.php");

$product = Product::byId($db, $_GET["id"]);
if(!$product) header("Location: index.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>trainWork | Заказать товар</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="wrapper">
    <?php include "layout/header.php" ?>
    <div class="content d-flex flex-column gap-3 justify-content-center align-items-center p-5">
        <div class="product-item d-flex flex-column gap-2 p-4 border border-secondary rounded-4">
            <p class="fs-6 fw-bold m-0"><?= $product["name"] ?></p>
            <p class="fs-6 fw-bold m-0">Цена: <?= $product["price"] ?></p>
            <form action="orders.php" method="post" class="d-flex flex-column gap-1 justify-content-center align-items-center">
                <input type="hidden" name="id" value="<?= $product["id"] ?>">
                <div class="d-flex">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="countInput" name="count" placeholder="count" value="1" required autocomplete="no">
                        <label for="countInput">Кол-во</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="addressInput" name="address" placeholder="address" value="" required autocomplete="no">
                        <label for="addressInput">Адрес</label>
                    </div>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-outline-danger">Заказать</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "layout/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
