<?php
include "database/db.php";
include "classes/Auth.php";
include "classes/Order.php";

if(Auth::isGuest()) header("Location: index.php");
if(Auth::userIsAdmin($db) && $_POST["id"] && $_POST["status"]) {
    Order::setStatus($db, $_POST["id"], $_POST["status"]);
}
if($_POST["id"] && $_POST["count"] && $_POST["address"]) {
    Order::create($db, $_POST["id"], $_POST["count"], $_POST["address"]);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>trainWork | Заказы</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="wrapper">
    <?php include "layout/header.php" ?>
    <div class="content d-flex flex-column gap-3  align-items-center p-5">
        <p class="fs-3 fw-bold m-0">Заказы:</p>
        <div class="d-flex flex-row flex-wrap gap-3 justify-content-center">
            <?php $orders = Order::all($db); ?>
            <?php if(!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="order-item d-flex flex-column gap-1 justify-content-center align-items-center p-4 border border-secondary rounded-4">
                        <p class="fs-5 fw-bold m-0">Заказ №<?= $order["id"] ?></p>
                        <p class="fs-6 m-0">Название товара: <?= $order["name"] ?></p>
                        <p class="fs-6 m-0">Количество: <?= $order["count"] ?></p>
                        <hr>
                        <?php if(Auth::userIsAdmin($db)): ?>
                            <p class="fs-6 m-0">Заказчик: <?= $order["full_name"] ?></p>
                            <p class="fs-6 m-0">Электронная почта: <?= $order["email"] ?></p>
                        <?php endif; ?>
                        <p class="fs-6 m-0">Адрес: <?= $order["address"] ?></p>
                        <?php if(Auth::isGuest()): ?>
                            <p class="fs-6 m-0">Статус: <?= $order["status"] ?></p>
                        <?php endif; ?>
                        <hr>
                        <p class="fs-6 m-0">Цена за шт.: <?= $order["price"] ?></p>
                        <p class="fs-6 m-0">Цена итого: <?= $order["total"] ?></p>
                        <?php if(Auth::userIsAdmin($db)): ?>
                            <hr>
                            <?php if($order["status_code"] === "new"): ?>
                                <div class="d-flex flex-row gap-3">
                                    <form action="orders.php" method="post" class="container-fluid">
                                        <input type="hidden" name="id" value="<?= $order["id"] ?>">
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-success">Подтвердить</button>
                                    </form>
                                    <form action="orders.php" method="post" class="container-fluid">
                                        <input type="hidden" name="id" value="<?= $order["id"] ?>">
                                        <input type="hidden" name="status" value="3">
                                        <button type="submit" class="btn btn-danger">Отменить</button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <p class="fs-5 m-0">Статус: <?= $order["status"] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
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
