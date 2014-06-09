<?php
session_start();
$LANG = 'pt_BR';
$http = '';
$include = '../../';
$admin_nome = 'ENPROP2013';
$email_adm = 'enprop2013@pucpr.br';
require("db.php");

require("_class/_class_proceeding.php");
$ev = new proceeding;

$filtro = UpperCaseSql($dd[1]);
echo $ev->imprime_todas_etiquetas_inscritos('',$filtro);
?>
