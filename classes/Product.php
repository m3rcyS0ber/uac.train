<?php

class Product
{
    public static function all(PDO $db): bool|array
    {
        $sqlRequest = "SELECT * FROM `product`";
        $sqlProducts = $db->query($sqlRequest);
        if($sqlProducts) {
            return $sqlProducts->fetchAll(PDO::FETCH_ASSOC);
        } else return false;
    }
    public static function byId(PDO $db, $id) {
        $sqlRequest = "SELECT * FROM `product` WHERE `product`.id = $id";
        $sqlProducts = $db->query($sqlRequest);
        if($sqlProducts->rowCount() > 0) {
            return $sqlProducts->fetchAll(PDO::FETCH_ASSOC)[0];
        } else return false;
    }
}