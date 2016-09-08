<?php
header("Content-type:text/html;charset=utf-8");

require_once __DIR__.'/../src/WebServiceApi.php';
function array_print($arr){
    echo "<ul>";
    foreach ($arr as $k=>$v){

        if(is_array($v)) {
            echo "<li>{$k}=>";
            array_print($v);
            echo "</li>";
        }else{
            echo "<li>{$k}=>{$v}</li>";
        }
    }
    echo "</ul>";
}

$api = new \yishuixm\lbs\WebServiceApi('');

$geocodeGeo = $api->geocodeGeo('重庆市');

if($geocodeGeo['accessGranted']){
    array_print($geocodeGeo['result']);
    $weatherInfo = $api->weatherInfo($geocodeGeo['result']['geocodes'][0]['adcode'],'base');
    array_print($weatherInfo);
}