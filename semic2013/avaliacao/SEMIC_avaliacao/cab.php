<?php
require('db.php');
require("_class/_class_head.php");
$hd = new head;

//Para compatibilidade com php4 
// adaptado de comentário em http://php.net/manual/pt_BR/function.pathinfo.php

if(version_compare(phpversion(), "5.2.0", "<")) {
    function pathinfo_filename($path) {
        $temp = pathinfo($path);
        return substr($temp['basename'],0 ,strlen($temp['basename'])-strlen($temp['extension'])-1);
    }
} else {
    function pathinfo_filename($path) {
        return pathinfo($path, PATHINFO_FILENAME);
    }
}
?>
