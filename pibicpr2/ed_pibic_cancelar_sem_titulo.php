<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();
require('../_class/_class_pibic_projetos.php');
$pj = new pibic_projetos;
$pj->projetos_cancelar_sem_titulo();

?>