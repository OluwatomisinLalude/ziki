<?php
function success(array $data){
    $rdata["status"] = "success";
    $rdata["data"] =$data;
    return $rdata;
}

function error($message){
    $data["status"] = "error";
    $data["message"] = $message;
    return $data;
}

function dd(...$value){
    foreach ($value as $data) {
        print_r($data);
        echo '</br> </br>';
    }
    exit;
}