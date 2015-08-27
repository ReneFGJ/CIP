<?php
error_reporting(255);
require('db.php');
require("_class/_class_head.php");
$hd = new head;
$hd->recupera_avalidor();

$idAvaliador = $hd->avaliador;
?>

