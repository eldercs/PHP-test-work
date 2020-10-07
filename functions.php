<?php
function shablon(string $adress,$arr = array()){
$adress_buffer="";
$adress = "templates/" . $adress . ".php";
if(file_exists($adress)){
    extract($arr, EXTR_REFS);
    //require_once($adress);
    ob_start();
    require_once($adress);
    $adress_buffer = ob_get_clean();
}
return $adress_buffer;
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