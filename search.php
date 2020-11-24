<?php
require_once "username.php";
require_once "functions.php";
require_once "init.php";

try {
    $my_array = fetchAll($con, 'SELECT * FROM `category`');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}
$gifs = []; 
mysqli_query($con,"CREATE FULLTEXT INDEX gif_ft_search ON gifs(title,description)");
$search = (isset($_GET['search'])) ? trim($_GET['search']) : null;
$search = mysqli_real_escape_string($con, $search);

if($search) {
    try {
        $lots = fetchAll($con, "SELECT l.`id`, l.`title`, `img`, `price`, `end_date`, c.`title` AS `category` FROM lots l JOIN category c ON l.`category_id` = c.`id` WHERE (l.`title` LIKE '%$search%' OR `description` LIKE '%$search%')   ORDER BY id DESC");
    } catch (Exception $e) {
        renderErrorTemplate($e->getMessage(), $username);
    }

    $page_content = shablon('search', [
        'my_array' => $my_array,
        'lots' => $lots,
        'search' => $search
    ]);
} else {
    $page_content = shablon('search', [
        'my_array' => $my_array,
        'lots' => null,
        'search' => $search
    ]);
}

echo shablon(
    'layout',
    [
        'my_array' => $my_array,
        'page_content' =>  $page_content, 
        'title' => 'Поиск',
        'username' => $username,
    ]
);
?>