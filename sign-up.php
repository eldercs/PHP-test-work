<?php
require_once 'functions.php';
require_once 'lots_list.php';
//require_once 'userdata.php';
require_once 'username.php';
require_once "init.php";
$errors = [];

try {
    $categories = fetchAll($con, 'SELECT * FROM `category`');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gif = $_POST;
    $requared = ['email', 'name', 'password', 'contacts'];
    foreach($requared as $name){
      //  $gif = $_POST;
        if (!array_key_exists($name, $gif) || empty($gif[$name])) {
            $errors[$name] = 'Это поле надо заполнить';
            print($errors[$name]);
        }
    } 
    if (!empty($_FILES['avatar']['name'])) {
    
        $tmpName = $_FILES['avatar']['tmp_name'];
        $folder = 'img/uploads/';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $path = $folder . $_FILES['avatar']['name'];
        $fileType = mime_content_type($tmpName);
        if ($fileType !== "image/jpeg" && $fileType !== "image/png") {
            $errors['avatar'] = 'Загрузите картинку в формате jpg или png';
        } else {
            move_uploaded_file($tmpName, $path);
            $gif['avatar'] = $path;
        }
    } else {
        $errors['avatar'] = 'Вы не загрузили файл';
    }
    if (!count($errors)) {
        $gif = array_map('htmlspecialchars', $gif);
        mysqli_report(MYSQLI_REPORT_ALL);
        $email = mysqli_real_escape_string($con, $gif['email']);
        mysqli_report(MYSQLI_REPORT_STRICT);
        $emailExists = mysqli_query($con, "SELECT `id` FROM `users` WHERE `email` = '$email'");
        if (mysqli_num_rows($emailExists) > 0) {
            $errors['email'] = 'Такой E-mail уже существует2';
        } else {
            $passwordHash = password_hash($gif['password'], PASSWORD_DEFAULT);
            try {
                $sql = "INSERT INTO `users` (`email`, `name`, `password`, `avatar`, `contacts`) VALUES ( ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, 'sssss', $email, $gif['name'], $passwordHash, $gif['avatar'], $gif['contacts']);
                mysqli_stmt_execute($stmt);
            } catch (Exception $e) {
                renderErrorTemplate($e->getMessage(), $username);
            }
            
           redirectTo('/login.php');
        }
     
    }
}
else {
    $page_content = shablon('templates/sign-up.php', [
        'table_array' => $table_array,
    ]);
}
$page_content = shablon(
    'sign-up',
    [   
    'table_array' => $table_array,
       'errors' => $errors,
    ]
    
); 
echo shablon(
    'layout',
    [
        'my_array' => $my_array,
        'page_content' =>  $page_content, 
        'title' => 'Регистрация',
        'username' => $username,
    ]
);
?>