<?php
require_once 'functions.php';
require_once 'username.php';
//require_once 'mysql_helper.php';
require_once "init.php";

function sum_price($price){
    $price = ceil($price);
    if($price>1000){
        $new_price = number_format($price, 0, ',', ' ');
    }
    else{
        $new_price = $price;
    }
    return $new_price."₽";
}
try {
   // $table_array = fetchAll($con, 'SELECT * FROM `lots` WHERE `end_date` > NOW()');
  // $table_array = fetchAll($con, 'SELECT * FROM `lots` ');
   // $sql = "SELECT * FROM `lots`";
  // $table_array = cache_get_data($con, $sql, [$_SESSION['user']], 'user_fav');
  // $content = shablon('index', ['table_array' => $table_array]);
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}
try {
    $my_array = fetchAll($con, 'SELECT *  FROM `category`');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}
$cur_page = $_GET['page'] ?? 1;
//print($cur_page);
$page_items = 3;
$resutl = mysqli_query($con, "SELECT COUNT(*) as cnt FROM `lots`");
$items_count = mysqli_fetch_assoc($resutl)['cnt'];
$pages_count = ceil($items_count/ $page_items);
$offset = ($cur_page - 1) * $page_items;

$pages =  range(1,$pages_count);

//$sql = 'SELECT * FROM lots'. ' LIMIT ' . $page_items . ' OFFSET ' . $offset;

$table_array = fetchAll($con, "SELECT * FROM `lots`  ORDER BY id DESC LIMIT " . $page_items . " OFFSET " . $offset);
$lot_time_remaining = "00:00";
$page_content = shablon(
    'index',
    [
        'table_array' => $table_array,
        'pages' => $pages,
        'pages_count' => $pages_count,
        'cur_page' => $cur_page
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
