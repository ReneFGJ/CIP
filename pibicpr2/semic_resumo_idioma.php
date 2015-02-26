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
echo $semic->idiomas_resumo();
echo $semic->idiomas_detalhe();
?>
</TABLE>
<? require("foot.php");	?>