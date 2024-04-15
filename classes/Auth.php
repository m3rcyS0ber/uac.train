<?php
session_start();
class Auth
{
    public static function isGuest() {
        return !isset($_SESSION['user_id']);
    }
    public static function getUserId(PDO $db) {
        if(self::isGuest()) return false;
        return $_SESSION['user_id'];
    }
    public static function getUser(PDO $db) {
        if(self::isGuest()) return false;
        $sqlRequest = "SELECT `user`.id, `role`.code AS 'role', `user`.login, `user`.full_name, `user`.phone, `user`.email FROM `user` INNER JOIN `role` ON `user`.`id_role` = `role`.id WHERE `user`.id = ". $_SESSION["user_id"];
        $sqlUser = $db->query($sqlRequest);
        if($sqlUser->rowCount() > 0) {
            return $sqlUser->fetchAll(PDO::FETCH_ASSOC)[0];
        } else return false;
    }
    public static function userIsAdmin(PDO $db) {
        if(self::isGuest()) return false;
        $sqlRequest = "SELECT `user`.id, `role`.code AS 'role' FROM `user` INNER JOIN `role` ON `user`.`id_role` = `role`.id WHERE `user`.id = ". $_SESSION["user_id"];
        $sqlUser = $db->query($sqlRequest);
        if($sqlUser->rowCount() > 0) {
            $sqlResult = $sqlUser->fetchAll(PDO::FETCH_ASSOC)[0];
            return $sqlResult["role"] === "admin";
        } else return false;
    }
    public static function logout() {
        unset($_SESSION["user_id"]);
    }
    public static function doLogin(PDO $db, $login, $password) {
        $sqlRequest = "SELECT * FROM `user` WHERE `user`.login = '$login' AND `user`.password = '$password'";
        $sqlUser = $db->query($sqlRequest);
        if($sqlUser->rowCount() > 0) {
            $sqlResult = $sqlUser->fetchAll(PDO::FETCH_ASSOC)[0];
            $_SESSION["user_id"] = $sqlResult["id"];
            header("Location: index.php");
        } else {
            $_SESSION["old"] = [
                "login"=>$login
            ];
            $_SESSION["login_error"] = [
              "all" => "Данные для входа не подходят."
            ];
        }
    }
    public static function doRegister(PDO $db, $data) {
        $_SESSION["reg_error"] = [];
        if($data["password"] !== $data["confirmPassword"]) {
            $_SESSION["reg_error"]["confirmPassword"] = "Пароли не сходятся.";
        }
        if(empty($_SESSION["reg_error"])) {
            $sqlStmt = $db->prepare("INSERT INTO `user`(id_role, login, password, full_name, phone, email) VALUES (1, ?, ?, ?, ?, ?)");
            $sqlStmt->execute([$data["login"], $data["password"], $data["fcs"], $data["phone"], $data["email"]]);
            self::doLogin($db, $data["login"], $data["password"]);
            header("Location: index.php");
        } else {
            $_SESSION["old"] = $data;
            header("Location: register.php");
        }
    }
}