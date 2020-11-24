<?php
require_once "functions.php";
require_once 'username.php';
require_once "init.php";
date_default_timezone_set('Europe/Moscow');
$key = $_GET['key'] ?? null;
$lot_id = $_GET['key'] ?? null;
/*if (!array_key_exists($lot_id, $my_array)){
    http_response_code(404);
    echo 'ошибка 404';
    exit();
}*/
$lotId = (isset($_GET['key'])) ? intval($_GET['key']) : null; 
try {
   // $bets = fetchAll($con, "SELECT `date`, `value`, `name` FROM `bets` JOIN users ON `user_id` = users.`id` WHERE `lot_id` = '$lotId' ORDER BY `date` DESC");
   // $bets = fetchAll($con, "SELECT `date`, `value`, `name` FROM `bets` JOIN users ON `user_id` = users.`id` WHERE `lot_id` = '$lotId' ORDER BY `date` DESC");
   $table_array = fetchAll($con, "SELECT * FROM `lots` ");
  // $bets = fetchAll($con, "SELECT * FROM `bets` WHERE `lot_id` = '$lotId' ORDER BY `date` DESC");
  $bets = fetchAll($con, "SELECT `date`, `value`, `name` FROM `bets` JOIN users ON `user_id` = users.`id` WHERE `lot_id` = '$lotId' ORDER BY `date` DESC");
  
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}
try {
    $my_array = fetchAll($con, 'SELECT * FROM `category`');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}

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
function cook($index){ // ДЛЯ подсчета просмотров
$counter_name = $index;
$counter_value = 1;
$expire = strtotime("1 days");
$path = "/";
if (isset($_COOKIE[$counter_name])) {
    $counter_value  = $_COOKIE[$counter_name];
    $counter_value++;
}
setcookie($counter_name, $counter_value, $expire, $path);
//echo $counter_name;
echo $counter_value;
}

$page_content = shablon(
    'lot',
    [
        'key' => $key,
        'table_array' => $table_array,
        'bets' => $bets,
      //  'lotId' => $lotId
    ]
);
echo shablon(
    'layout',
    [
        'page_content' =>  $page_content,
        'my_array' => $my_array,
        'title' => htmlspecialchars($table_array[$key]['title']),
        'username' => $username,
    ]
);

?>