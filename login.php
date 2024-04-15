<?php

require "database/db.php";
include "classes/Auth.php";
if(!Auth::isGuest()) header("Location: index.php");
unset($_SESSION["old"]);
unset($_SESSION["login_error"]);
if($_POST["login"] && $_POST["password"]) {
    Auth::doLogin($db, $_POST["login"], $_POST["password"]);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>trainWork | Вход</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="wrapper">
    <?php include "layout/header.php" ?>
    <div class="content d-flex flex-column gap-3 justify-content-center align-items-center p-5">
        <form method="post" action="login.php" class="d-flex flex-column gap-3 justify-content-center align-items-center py-4 px-5 rounded-4 border border-success">
            <p class="fs-2 fw-bold w-100 text-center m-0">Авторизация</p>
            <div class="form-floating">
                <input type="text" class="form-control" id="loginInput" name="login" placeholder="login" value="<?= $_SESSION["old"]["login"] ?? "" ?>" required autocomplete="login">
                <label for="loginInput">Логин</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="password" required autocomplete="current-password">
                <label for="passwordInput">Пароль</label>
            </div>
            <?php if(isset($_SESSION["login_error"]["all"])): ?>
            <p class="fs-6 fw-bold w-100 text-center text-danger border border-danger rounded-4 p-3 m-0"><?= $_SESSION["login_error"]["all"] ?></p>
            <?php endif; ?>
            <div class="d-flex flex-column gap-2">
                <button type="submit" class="btn btn-outline-primary">Войти</button>
                <a href="./register.php" class="btn btn-outline-success">Зарегистрироваться</a>
            </div>
        </form>
    </div>
</div>
<?php include "layout/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
