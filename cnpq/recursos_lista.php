<?
$breadcrumbs=array();
require("cab_cnpq.php");

require("../_class/_class_pibic_recurso.php");
$rec = new recurso;

echo '<H1>Recusos / Reconsidera��es '.$dd[1].'</h1>';

if (date("Ymd") < 20150731)
	{
		echo '<font color="red" class="lt2">Nenhum pedido de recurso registrado, o recurso ser� aberto ap�s promunga��o do edital de '.date("Y").'</font>';
		
		echo '<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>';
	} else {
		echo $rec->resumo($dd[1]);		
	}


require("../foot.php");	
?>