<?php
require_once 'functions.php';
require_once 'lots_list.php';
require_once 'username.php';
$add_lots = ['name' => '', 'category' => '' , 'description' => 'Описание', 'price' => '0', 'img'=>'png'];
$errors = [];
if($username == null){
    header("Location: /login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $requared = ['name', 'category', 'description', 'end_date'];
    $is_numeric = [
        'price',
        'lot-step'
    ];
   // $errors = [];
     foreach($requared as $name){
        $gif = $_POST;
        if (!array_key_exists($name, $gif) || empty($gif[$name])) {
            $errors[$name] = 'Это поле надо заполнить';
            print($errors[$name]);
        }
    } 
/*     foreach($my_array as $value){
        $gif = $_POST;
        if(!array_key_exists($value,$gif)){
            $errors[$value] = 'Это поле надо заполнить2';
            print($errors[$value]);
        }
    } */
    $gif = $_POST;
   foreach($is_numeric as $name){
    $gif = $_POST;
    if(intval($gif[$name]) <= 0){
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
}

$page_content = shablon(
    'add',
    [
      'table_array' => $table_array,
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