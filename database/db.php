<?php
$db = null;
$dberr = false;
$dberrcode = false;
try {
    $db = new PDO('mysql:host=localhost:3306;dbname=demotrain','root','');
} catch( PDOException $e ) {
    $dberrcode = $e->getCode();
    $dberr = $e->getMessage();
}