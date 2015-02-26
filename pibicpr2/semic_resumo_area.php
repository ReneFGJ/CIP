<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); } else { echo 'message not found'; }	
require('../_class/_class_semic.php');
$semic = new semic;
echo '<CENTER><H3>'.msg('titulo_idioma').'</H3></center>';
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
echo $semic->area_resumo_gr($dd[1],$dd[2]);
echo $semic->area_resumo();
echo $semic->area_detalhe();
?>
</TABLE>
<? require("foot.php");	?>