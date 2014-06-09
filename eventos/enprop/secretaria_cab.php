<?php
$include = '../../';
require("db.php");
require("_class/_class_secretaria.php");
$sc = new secretaria;
$admin_nome = 'ENPROP2013-PUCPR';
$email_adm = 'enprop2013@pucpr.br';
echo '<A HREF="secretaria.php">Home</A>';
echo $sc->cab();



?>
