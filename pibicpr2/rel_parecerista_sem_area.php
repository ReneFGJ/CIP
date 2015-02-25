<?php
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
require('../_class/_class_pareceristas.php');
$par = new parecerista;

echo $par->parecerista_sem_area();

require("foot.php");	
?>