<?php
require("db.php");
require($include.'sisdoc_email.php');
require($include.'sisdoc_form2.php');

/* Messagens */
require("../_class/_class_message.php");
$LANG = 'pt_BR';
$file = "../messages/msg_".$LANG.".php";
if (file_exists($file)) { require($file); } else { echo 'Message not found. '.$file; exit; }

require('../_class/_class_submit.php');
$subm = new submit;
?>
<header>
	<title>Reenvio de senha                                                                                       </title>
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/pb/skin/A0001/estilo.css" type="text/css" />
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/public/62/css/estilo.css" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</header>
<?
if (strlen($dd[1]) > 0)
	{
		require("_email.php");
		$subm->send_password($dd[1]);
	} else {
	?>
	<form action="<?=page()?>">
		<H2><font color="white">Recuperação de senha</font></H2>
		<BR>
		<font color="white">Informe seu e-mail<BR>
		<input type="text" name="dd1" size="50" maxlength="100">
		<BR>
		<input type="submit" name="dd50" value="enviar senha por e-mail >>>">		
	</form>
	<? } ?>
