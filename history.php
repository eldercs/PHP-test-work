<?php
require_once 'functions.php';
require_once 'lots_list.php';
require_once "init.php";
function sum_price($price){
    $price = ceil($price);
    if($price>1000){
        $new_price = number_format($price, 0, ',', ' ');
    }
    else if($price == null){
        return null;
    }
    return $new_price."₽";
}
$page_content = shablon(
    'history',
[
    'table_array' => $table_array,
]
);
echo shablon(
    'layout',
    [
        'my_array' => $my_array,
        'page_content' =>  $page_content, 
        'title' => 'Избранные'
    ]
);

?>