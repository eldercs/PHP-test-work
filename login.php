<?php
require_once 'functions.php';
require_once 'lots_list.php';
require_once 'userdata.php';
require_once 'username.php';
require_once "init.php";
//session_start();
try {
    $my_array = fetchAll($con, 'SELECT * FROM `category`');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $username);
}

$add_lots = ['email' => '', 'password' => ''];
$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requared = ['email','password'];
    $gif = $_POST;
    $errors = [];
    foreach($requared as $name){
        if (empty($gif[$name])) {
            $errors[$name] = 'Это поле надо заполнить';
        }
    }
    
    if (!count($errors)) {
        $email = mysqli_real_escape_string($con, $gif['email']);
        $password = mysqli_real_escape_string($con, $gif['password']);
        try {
           // $user = fetchOne($con, "SELECT * FROM users WHERE email = '$email'");
           $emailExist = mysqli_query($con,"SELECT * FROM users WHERE email = '$email'");
           $emailExist = mysqli_fetch_array($emailExist, MYSQLI_ASSOC);
        } catch (Exception $e) {
            renderErrorTemplate($e->getMessage(), $username);
        }

        if (password_verify($gif['password'], $emailExist['password'])) {
            $_SESSION['user'] = $emailExist;
            redirectTo();
        } else {
            $errors['all'] = 'Вы ввели неверный E-mail/пароль';
        }
    }
    if(count($errors)){
        $page_content = shablon('login.php', ['errors' => $errors, 'gif' => $gif, 'name' => $name ]);
    }
}
else{
        $page_content = shablon('index.php', ['my_array' => $my_array,]);
}
 $page_content = shablon(
    'login',
    [   
       'errors' => $errors,
    ]
    
); 
echo  shablon(
    'layout',
    [
        'my_array' => $my_array,
        'page_content' =>  $page_content, 
        'title' => 'Авторизация',
        'username' => $username,
    ]
);
//print($page_content);
?>