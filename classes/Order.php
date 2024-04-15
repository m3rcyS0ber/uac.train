<?php

class Order
{
    public static function all(PDO $db): bool|array
    {
        $sqlRequest = "SELECT `order`.id, `order`.count, `order`.address,
                   `product`.name, `product`.price, (`order`.count*`product`.price) AS 'total',
                    `status`.name AS 'status',`status`.name AS 'status', 
                    `status`.code AS 'status_code' 
                    FROM `order` 
                    INNER JOIN `product` ON `order`.id_product = `product`.id 
                    INNER JOIN `status` ON `order`.id_status = `status`.id 
                    WHERE `order`.id_user = ". Auth::getUserId($db) . "
                    ORDER BY `order`.id";
        if(Auth::userIsAdmin($db)) {
            $sqlRequest = "SELECT `order`.id, `order`.id_product, `order`.count,
                           `order`.address, `product`.name, `product`.price,
                           (`order`.count*`product`.price) AS 'total',
                            `status`.name AS 'status', `status`.code AS 'status_code',
                             `user`.full_name, `user`.email 
                            FROM `order` 
                            INNER JOIN `product` ON `order`.id_product = `product`.id 
                            INNER JOIN `status` ON `order`.id_status = `status`.id 
                            INNER JOIN `user` ON `order`.id_user = `user`.id
                            ORDER BY `order`.id";
        }
        $sqlProducts = $db->query($sqlRequest);
        if($sqlProducts) {
            return $sqlProducts->fetchAll(PDO::FETCH_ASSOC);
        } else return false;
    }
    public static function setStatus(PDO $db, $id, $statusId): bool
    {
        $sqlRequest = "UPDATE `order` SET `order`.id_status = ". $statusId ." WHERE `order`.id = $id";
        $result = $db->query($sqlRequest);
        return true;
    }
    public static function create(PDO $db, $id, $count, $address) {
        $sqlStmt = $db->prepare("INSERT INTO `order`(id_user, id_product, id_status, count, address) VALUES (?, ?, ?, ?, ?)");
        $sqlStmt->execute([Auth::getUserId($db), $id, 1, $count, $address]);
    }
}