<?php
require_once("functions.php");
require_once("lots_list.php");
date_default_timezone_set('Europe/Moscow');
$key = $_GET['key'] ?? null;
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
    'lot',
    [
        //'bet_done' => $bet_done,
        //'bets' => $bets,
        'key' => $key,
        //'lots' => $lots,
        'table_array' => $table_array,
    ]
);
echo shablon(
'layout',
[
    'page_content' =>  $page_content,
    'my_array' => $my_array,
/*     'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar, */
    'title' => htmlspecialchars($table_array[$key]['title']),
]
);
?>