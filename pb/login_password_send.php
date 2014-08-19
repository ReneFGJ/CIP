<?php
require("db.php");
require($include.'sisdoc_email.php');
require($include.'sisdoc_form2.php');
?>
<header>
	<title>Reenvio de senha                                                                                       </title>
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/pb/skin/A0001/estilo.css" type="text/css" />
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/public/62/css/estilo.css" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<script type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery.js"></script>
		<script type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery.corner.js"></script>
		<script type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery.example.js"></script>
		<script type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery.autocomplete.js"></script>
</header>
<?
if (strlen($dd[1]) > 0)
	{
		$sql = "select * from evento_cadastro where ec_email_1 = '".$dd[1]."' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
				require("_email.php");
				$senha = trim($line['ec_senha']);
				$nome = trim($line['ec_nome_inscrito']);
				$texto = 'Prezado '.$nome;
				$texto .= '<BR><BR>Conforme solicitado sua senha é :<B>'.$senha.'</B>';
				enviaremail(trim($line['ec_email_1']),'','Recuperação de senha',$texto);
				enviaremail('renefgj@gmail.com','','Recuperação de senha',$texto);				
				echo '
				<H2><font color="white">Recuperação de senha</font></H2>
				<BR>
				<font color="white">
				Foi enviada sua senha para o e-mail '.$dd[1];				
			} else {
				echo '
				<H2><font color="white">Erro na recuperação de senha</font></H2>
				<BR>
				<font color="white">
				Não foi localizado no sistema o e-mail '.$dd[1];				
			}
		
		
		
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
