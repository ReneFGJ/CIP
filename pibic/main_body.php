<?
require($include."sisdoc_calendario.php");
$tab_max = '80%';
?>
<table cellpadding="3" cellspacing="0" width="<?=$tab_max;?>" border=0 align="center" class="lt1">
<TR valign="top">
	<TD width="66%">
	<img src="img/nada.gif" width="2" height="8" alt="" border="0">
	<? require("main_projetos.php");?>
	<img src="img/nada.gif" width="2" height="8" alt="" border="0">
	<? 
	require("main_busca.php");
	require("main_protocolos.php");
	?>
	</TD>
	<TD width="33%">
	<img src="img/nada.gif" width="2" height="8" alt="" border="0">
	<? 
	// require("main_calendario.php");
	?>
	<img src="img/nada.gif" width="2" height="8" alt="" border="0">
	<? // require("main_recados.php");
	?>
	<img src="img/nada.gif" width="2" height="8" alt="" border="0">
	<? 
	// require("main_aniversariantes.php");
	?>
	</TD>
</TR>
</table>