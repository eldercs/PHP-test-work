<?php
require_once 'functions.php';
require_once 'username.php';
require_once 'mysql_helper.php';
require_once "init.php";
$add_lots = ['name' => '', 'category' => '' , 'description' => 'Описание', 'price' => '0', 'img'=>'png'];
$errors = [];
if($username == null){
    header("Location: /login.php");
    exit();
}
try {
    $my_array = fetchAll($con, 'SELECT * FROM `category`');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $requared = ['name', 'category', 'description', 'end_date'];
    $is_numeric = [
        'price',
        'bet_step',
    ];
   // $errors = [];
     foreach($requared as $name){
        $gif = $_POST;
        if (!array_key_exists($name, $gif) || empty($gif[$name])) {
            $errors[$name] = 'Это поле надо заполнить';
            print($name);
        }
    } 
   
   // $gif = $_POST;
   foreach($is_numeric as $name){
    $gif = $_POST;
    if(!is_numeric($gif[$name]) || intval($gif[$name]) <= 0){
   /*      if (array_key_exists($name, $lot) && $lot[$name] && (!is_numeric($lot[$name]) || intval($lot[$name]) <= 0)) { */
            $errors[$name] = 'Введите число больше нуля';
            print($errors[$name]);
            print($name);
        }
    }
    $gif = $_POST;
    if (!empty($_FILES['img']['name'])) {
    
        $tmpName = $_FILES['img']['tmp_name'];
        $folder = 'img/uploads/';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $path = $folder . $_FILES['img']['name'];
        $fileType = mime_content_type($tmpName);
        if ($fileType !== "image/jpeg" && $fileType !== "image/png") {
            $errors['img'] = 'Загрузите картинку в формате jpg или png';
        } else {
            move_uploaded_file($tmpName, $path);
            $gif['img'] = $path;
        }
    } else {
        $errors['img'] = 'Вы не загрузили файл';
    }
    if(strtotime($gif['end_date']) < strtotime('tomorrow')) {
        $errors['end_date'] = 'Введите дату больше текущей даты';
    }
    if(count($errors)){
        $page_content = shablon('add',
        [
            'errors' => $errors,
            'add_lots' => $add_lots,
            'my_array' => $my_array,
        ]);
    }
    else{
        $gif = array_map('htmlspecialchars', $gif);
        $sql = "INSERT INTO `lots` (`user_id`, `img`, `title`, `price`, `category_id`, `bet_step`, `start_date`,`end_date`,`description`) VALUES ('$username[id]', ?, ?,  ?, ?, ?, NOW(), ?, ?)";
        $add_st = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($add_st,'ssiiiss', $gif['img'], $gif['name'], $gif['price'],$gif['category'],$gif['bet_step'],$gif['end_date'], $gif['description']);
        mysqli_stmt_execute($add_st);
      //  cache_del_data([$_SESSION['user_id']], 'user_fav');
    }
}

$page_content = shablon(
    'add',
    [
      'my_array' => $my_array,
      'add_lots' => $add_lots,
      'errors' => $errors,
      //'my_array' => $my_array
    ]
);
echo shablon(
    'layout',
    [
        'my_array' => $my_array,
        'page_content' =>  $page_content, 
        'title' => 'Добавление лота',
        'username' => $username,
    ]
);
?>