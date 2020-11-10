<?php
//require_once('functions.php');
require_once 'functions.php';
//require_once 'lots_list.php';
require_once 'username.php';
require_once "init.php";
//require_once 'history.php';
function sum_price($price){
    $price = ceil($price);
    if($price>1000){
        $new_price = number_format($price, 0, ',', ' ');
    }
    return $new_price."₽";
}
try {
    $table_array = fetchAll($con, 'SELECT * FROM `lots`');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}
try {
    $my_array = fetchAll($con, 'SELECT * FROM `category`');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}
$lot_time_remaining = "00:00";
$page_content = shablon(
    'index',
    [
        'table_array' => $table_array,
        //'lot_time_remaining' => $lot_time_remaining
    ]
);
echo shablon(
    'layout',
    [
        'page_content' =>  $page_content,
        'my_array' => $my_array,
        'title' => 'Главная',
        'username' => $username,
    ]
);
?>
