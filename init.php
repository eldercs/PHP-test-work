<?php
$con = mysqli_connect("localhost","root","","yeticave");
if($con == false){
    print("Ошибка подключения". mysqli_connect_error());
}
else
//print("соединение установлено");
mysqli_set_charset($con, "utf8");
?>