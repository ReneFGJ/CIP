<style>
#prgs {
	border : 1px dashed Black;
	color : Gray;
	padding-bottom : 12px;
	padding-left : 12px;
	padding-right : 6px;
	padding-top : 6px;
}
</style>
<BR>
<font class="lt1_sub">
<img src="img/marcado_setas.png" width="27" height="12" alt="" border="0" align="absmiddle"><B>Protocolos para aprecia��o</B>
</font><BR><font class="lt1">
<?

?>
<table width="100%" cellpadding="3" cellspacing="0" class="lt1" border="0">
<? $st = '<div id="prgs">&raquo;&nbsp;<B>Projetos para sua aprecia��o</B>'; $tipo = '1' ; require('_protocolo_abertos.php'); ?>
<? $st = '<div id="prgs">&raquo;&nbsp;<B>Projetos para sua revis�o</B>';    $tipo = '2' ; require('_protocolo_abertos.php'); ?>

<? $st = '<div id="prgs">&raquo;&nbsp;<B>Projetos avaliados (avaliados)</B>'; $tipo = '3' ; require('_protocolo_abertos.php'); ?>
<? $st = '<div id="prgs">&raquo;&nbsp;<B>Projetos avaliados (revis�o)</B>'; $tipo = '4' ; require('_protocolo_abertos.php'); ?>
</table>

