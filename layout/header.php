<?php
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid d-flex flex-row gap-2 justify-content-between align-items-center">
        <a class="navbar-brand" href="../index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="../index.php">Главная</a>
            </div>
        </div>
        <?php if(Auth::isGuest()): ?>
            <div class="d-flex flex-row gap-3 align-items-center justify-content-center">
                <a href="../login.php" type="button" class="btn btn-outline-primary">Войти</a>
                <p class="fs-6 m-0">или</p>
                <a href="../register.php" type="button" class="btn btn-outline-success">Регистрация</a>
            </div>
        <?php else: ?>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= Auth::getUser($db)["full_name"] ?>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="../index.php">Главная</a></li>
                    <li><a class="dropdown-item" href="../orders.php">Заказы</a></li>
                    <li><a class="dropdown-item" href="../logout.php">Выйти из аккаунта</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>
