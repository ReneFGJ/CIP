<?php
require("cab.php");
require("../_class/_class_semic_paineis.php");
$sm = new semic_paineis;
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';


$file = '../messages/msg_index.php';
if (file_exists($file)) { require($file); }

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
if (($perfil->valid('#PIT')) or ($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
		$rlt = fopen('painel02.txt','r');
		$st = '';
		while (!(feof($rlt)))
			{
				$st .= fread($rlt,2024);
			}
		fclose($rlt);
	}
	$sm->inport_paineis($st,20131024);
?>