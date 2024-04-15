<?php

include "database/db.php";
include "classes/Auth.php";

unset($_SESSION["old"]);
unset($_SESSION["reg_error"]);

if($_POST["login"] && $_POST["fcs"] && $_POST["phone"] && $_POST["email"] && $_POST["password"] && $_POST["confirmPassword"]) {
    Auth::doRegister($db, $_POST);
}

if(!Auth::isGuest()) header("Location: index.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>trainWork | Регистрация</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="wrapper">
    <?php include "layout/header.php" ?>
    <div class="content d-flex flex-column gap-3 justify-content-center align-items-center p-5">
        <form method="post" action="register.php" class="d-flex flex-column gap-3 justify-content-center align-items-center py-4 px-5 rounded-4 border border-success">
            <p class="fs-2 fw-bold w-100 text-center m-0">Регистрация</p>
            <div class="d-flex flex-column gap-1 w-100">
                <div class="form-floating">
                    <input type="text" class="form-control" id="fcsInput" name="fcs" placeholder="fcs" value="<?= $_SESSION["old"]["fcs"] ?? "" ?>" required autocomplete="no">
                    <label for="fcsInput">ФИО</label>
                </div>
                <?php if(isset($_SESSION["reg_error"]["fcs"])): ?>
                    <p class="fs-6 fw-bold w-100 text-center text-danger border border-danger rounded-4 p-3 m-0"><?= $_SESSION["reg_error"]["fcs"] ?></p>
                <?php endif; ?>
            </div>
            <div class="d-flex flex-column gap-1 w-100">
                <div class="form-floating">
                    <input type="text" class="form-control" id="loginInput" name="login" placeholder="login" value="<?= $_SESSION["old"]["login"] ?? "" ?>" required autocomplete="no">
                    <label for="loginInput">Логин</label>
                </div>
                <?php if(isset($_SESSION["reg_error"]["login"])): ?>
                    <p class="fs-6 fw-bold w-100 text-center text-danger border border-danger rounded-4 p-3 m-0"><?= $_SESSION["reg_error"]["login"] ?></p>
                <?php endif; ?>
            </div>
            <div class="d-flex flex-column gap-1 w-100">
                <div class="form-floating">
                    <input type="email" class="form-control" id="emailInput" name="email" placeholder="email" value="<?= $_SESSION["old"]["email"] ?? "" ?>" required autocomplete="no">
                    <label for="emailInput">Электронная почта</label>
                </div>
                <?php if(isset($_SESSION["reg_error"]["email"])): ?>
                    <p class="fs-6 fw-bold w-100 text-center text-danger border border-danger rounded-4 p-3 m-0"><?= $_SESSION["reg_error"]["email"] ?></p>
                <?php endif; ?>
            </div>
            <div class="d-flex flex-column gap-1 w-100">
                <div class="form-floating">
                    <input type="tel" class="form-control" id="phoneInput" name="phone" placeholder="phone" value="<?= $_SESSION["old"]["phone"] ?? "" ?>" required autocomplete="no">
                    <label for="phoneInput">Телефон</label>
                </div>
                <?php if(isset($_SESSION["reg_error"]["phone"])): ?>
                    <p class="fs-6 fw-bold w-100 text-center text-danger border border-danger rounded-4 p-3 m-0"><?= $_SESSION["reg_error"]["phone"] ?></p>
                <?php endif; ?>
            </div>
            <div class="d-flex flex-column gap-1 w-100">
                <div class="form-floating">
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="password" required autocomplete="current-password">
                    <label for="passwordInput">Пароль</label>
                </div>
                <?php if(isset($_SESSION["reg_error"]["password"])): ?>
                    <p class="fs-6 fw-bold w-100 text-center text-danger border border-danger rounded-4 p-3 m-0"><?= $_SESSION["reg_error"]["password"] ?></p>
                <?php endif; ?>
            </div>
            <div class="d-flex flex-column gap-1 w-100">
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirmPasswordInput" name="confirmPassword" placeholder="confirm_password" required autocomplete="new-password">
                    <label for="confirmPasswordInput">Повторите пароль</label>
                </div>
                <?php if(isset($_SESSION["reg_error"]["confirmPassword"])): ?>
                    <p class="fs-6 fw-bold w-100 text-center text-danger border border-danger rounded-4 p-3 m-0"><?= $_SESSION["reg_error"]["confirmPassword"] ?></p>
                <?php endif; ?>
            </div>
            <div class="d-flex flex-column gap-2">
                <button type="submit" class="btn btn-outline-success">Зарегистрироваться</button>
                <a href="./login.php" class="btn btn-outline-primary">Войти</a>
            </div>
        </form>
    </div>
</div>
<?php include "layout/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
