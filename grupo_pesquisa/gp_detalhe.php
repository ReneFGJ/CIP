<?
$breadcrumbs=array();
require("cab.php");
require($include.'sisdoc_windows.php');

require("../_class/_class_grupo_de_pesquisa.php");
$gp = new grupo_de_pesquisa;

echo $gp->le($dd[0]);

echo $gp->mostra_dados();
if ($perfil->valid('#ADM#SPI#CPI#SCR'))
	{
	 echo '<a href="#" onclick="newxy2(\'gp_editar.php?dd0='.$dd[0].'\',600,600);">editar</A>';	
	}

require("../foot.php");
?>