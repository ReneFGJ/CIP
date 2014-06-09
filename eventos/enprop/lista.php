<?php
session_start();
$LANG = 'pt_BR';
$http = '';
$include = '../../';
$admin_nome = 'ENPROP2013';
$email_adm = 'enprop2013@pucpr.br';
require("db.php");

$filename ="enprop_".date("Ymd_Hi").".xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);

require($include.'sisdoc_data.php');

require("_class/_class_proceeding.php");
$evento = new proceeding;

echo $evento->lista_inscritos();
?>