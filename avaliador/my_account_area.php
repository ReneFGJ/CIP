<?php
session_start();
ob_start();

$include = '../';
require("../db.php");	
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require('../_class/_class_language.php');

require("../_class/_class_pareceristas.php");
$par = new parecerista;
$par->security();
$file = '../messages/msg_'.page();
if (file_exists($file)) { require($file); }
if ($dd[1]=='ADD')
{
	if (strlen($dd[2]) == 7)
	{
		$par->area_adiciona($dd[2]);
	}
}


$edit = 1;
/* Areas cadastradas */
echo '<h1>Áreas de conhecimento indicadas para avaliação</h1>';
echo $par->mostra_areas();
echo '<BR><BR>';

?>