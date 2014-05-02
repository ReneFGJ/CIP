<?php
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
require('../_class/_class_ic.php');
$ic = new ic;


	/* Dados da Classe */
	require('../_class/_class_agencia_editais.php');

	$clx = new agencia_editais;
	$tabela = $clx->tabela;
 	$texto = $clx->mostra_edital_email($dd[0]);
	echo $texto;

if (strlen($dd[2]) == 0) {
	$txt = $ic->ic('edital_email_dsi'); 
	$dd[3] = 'Edital '.trim($clx->agencia_sigla).' '.trim($clx->edital_nr).'/'.trim($clx->edital_ano).' - '.trim($clx->edital_nome). ' '; 
	$dd[2] = mst($txt['nw_descricao']); 
	}

if (strlen($acao) > 0)
	{
		$email = array();
		if ($dd[10]=='1')
			{
				array_push($email,'renefgj@gmail.com');
				array_push($email,'cip@pucpr.br');
				array_push($email,'paula.trevilatto@pucpr.br');
			}
			
			
		/* Enviar e-email */
		require("_email.php");
		$font1 = '<font style="font-family: Verdana, Arial, Tahoma, Serif; font-size:12px;">';
		$texto .= $font1.$dd[2]; 
		for ($r=0;$r < count($email);$r++)
			{
				$em = $email[$r];
				enviaremail($em,'',$dd[3],$texto);
				echo '<BR>enviado para '.$em;
			}
		require("../foot.php");
		exit;
	}
	
?>
<form method="get" action="agencia_editais_detalhe_email.php">
	<input type="hidden" value="<?php echo $dd[0];?>" name="dd0">
	<table width="700" align="center" class="lt1">
		<TR><TD><?=msg("email_subject");?><BR>
			<input type="text" value="<?=$dd[3];?>" size="100" maxlength="100" name="dd3"></TD></TR>
		<TR><TD><?=msg("email_content");?><BR>
			<textarea rows=10 cols=60 names="dd2"><?=$dd[2];?></textarea></TD></TR>
		<TR><TH>Selecione o grupo de usuários</TH></TR>
		<TR><TD><input type="checkbox" value="1" name="dd10"><?=msg("editais_gr1");?></TD></TR>
		<TR><TD><input type="checkbox" value="1" name="dd11"><?=msg("editais_gr2");?></TD></TR>
		<TR><TD><input type="checkbox" value="1" name="dd12"><?=msg("editais_gr3");?></TD></TR>
		<TR><TD><input type="checkbox" value="1" name="dd13"><?=msg("editais_gr4");?></TD></TR>
		<TR><TD><input type="checkbox" value="1" name="dd14"><?=msg("editais_gr5");?></TD></TR>		
	</table>
	<input type="submit" name="acao" value="Confirmar Envio >>" style="width: 300px; height: 50px;">
</form>
<?
	
require("../foot.php");		
?> 