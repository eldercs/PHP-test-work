<?php
function shablon(string $adress,$arr = array()){
$adress_buffer="";
$adress = "templates/" . $adress . ".php";
if(file_exists($adress)){
    extract($arr, EXTR_REFS);
    //require_once($adress);
    ob_start();
    include $adress; 
    $adress_buffer = ob_get_clean();
}
return $adress_buffer;
}
function redirectTo($path="/"){
    header("Location:{$path}");
    exit();
}
function searchUserByEmail($email, $users){
    $result = null;
    foreach($users as $user){
        if($user['email']==$email){
            $result = $user;
        break;
        }
    }
    return $result;
}



function fetchOne($con, $sql) {
    if ($result = mysqli_query($con, $sql)) {
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else {
        throw new Exception(mysqli_error($con));
    }
}
function fetchAll($con, $sql) {
    if ($result = mysqli_query($con, $sql)) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        throw new Exception(mysqli_error($con));
    }
}

function renderErrorTemplate($error, $username) {
print("такой email уже есть");
  //  echo $layout_content;
    exit();
}
function nowtotime(){
    date_default_timezone_set('Europe/Moscow');
    $time_hour = 86400;
    $now_time = strtotime('now');
    $ts_midnight = strtotime('tomorrow');
    $format = floor(($ts_midnight - $now_time)/3600);
    $format2 = floor((($ts_midnight - $now_time)%3600)/60);
    return $format . " часа " . $format2 . " минут";
}

?>