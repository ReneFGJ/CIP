<?php

if ($_GET['printer']=='S')
{
$include = '../';
require("../db.php");
require('../_class/_class_pibic_projetos_v2.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_autor.php');

$relatorio_titulo = "Edital ".$dd[1]." ".date("Y")."/".(date("Y")+1)." - Resultado do Processo de Seleção de Bolsas de Iniciação Científica";
$edital = new projetos;
?>
<link rel="STYLESHEET" type="text/css" href="../css/ic-edital.css">
<body topmargin="0" leftmargin="0" rightmargin="0">
<TABLE width="100%">
	<TR>
		<TD width="30%" valign="top">
		<img src="../img/logo_ic_pibic.png" height="80" alt="" border="0">
		</TD>
		<TD class="lt5" align="center"><?=$relatorio_titulo;?><?=$tit1;?></TD>
		<TD width="30%" align="right" valign="top"><NOBR>
		<img src="img/logo_pucpr.jpg" height="90" alt="" border="0">&nbsp;

		<img src="img/logo_fundacao_araucaria.jpg" height="50" alt="" border="0">
		</TD>
	</TR>
</TABLE>
<?
	
	echo $hb;
} else {
	require("cab.php");
	require('../_class/_class_pibic_projetos.php');
	require($include.'sisdoc_colunas.php');
	require($include.'sisdoc_autor.php');
	echo '11';
	$relatorio_titulo = "Edital PIBIC ".date("Y")."/".(date("Y")+1)." - Resultado do Processo de Seleção de Bolsas de Iniciação Científica";
	$edital = new pibic_projetos;	
		
}
echo $edital->mostra_edital_email(date("Y"),$dd[3].$dd[0],$dd[1],'F');
?>
