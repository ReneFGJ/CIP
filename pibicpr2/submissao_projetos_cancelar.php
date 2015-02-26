<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$S8','','Protocolo (para cancelar)',True,True,''));
echo '<CENTER><font class=lt5>Agrupar protocolos com o mesmo nome</font></CENTER>';
?><TABLE width="500" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE><?	

$tabela = "pibic_submit_documento";
/////////////////////////////////////////////////////////////////// Relatório Parcial
if ($saved > 0)
		{
		echo '<table width="'.$tab_max.'">';
		$sql = "select * from $tabela where doc_protocolo = '".$dd[1]."' and doc_protocolo_mae <> '' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$tit_1 = trim(uppercaseSQL($line['doc_1_titulo']));
			$pro_1 = $line['doc_autor_principal'];
			$edi_1 = $line['doc_edital'];
			$ano_1 = $line['doc_ano'];
			$sta_1 = trim($line['doc_status']);
			$mae_1 = trim($line['doc_protocolo_mae']);
	
			}
		$err = 0;
		echo '<tr><TH colspan="3" class="lt4">Cancelar protocolo '.$dd[1].'</TH></tr>';
		/// Ponto 1
		echo '<tr '.coluna().'><TD width="20">1</TD><td>Protocolo do aluno esta ativo</td>';
		if (($sta_1 == 'A') or ($sta_1 == 'B')  or ($sta_1 == 'C')  or ($sta_1 == 'D'))
			{ echo '<TD><font color=green>OK</TD>'; } else { echo '<TD><font color=red>Não OK!</font></TD>'; $err++; }

		echo '<tr '.coluna().'><TD width="20">1</TD><td>É projeto de aluno?</td>';
		if ($mae_1  != '')
			{ echo '<TD><font color=green>OK</TD>'; } else { echo '<TD><font color=red>Não OK!</font></TD>'; $err++; }

		/// Ponto 2

		if (($err == 0) and (strlen($dd[10]) == 0))
			{
			echo '<TR><TD colspan="3">';
			?>
			<form method="post" action="submissao_projetos_cancelar.php">
			<input type="hidden" name="dd0" value="<?=$dd[0];?>">
			<input type="hidden" name="dd1" value="<?=$dd[1];?>">
			<input type="hidden" name="dd2" value="<?=$dd[2];?>">
			<input type="hidden" name="dd3" value="<?=$dd[3];?>">
			<input type="hidden" name="dd4" value="<?=$dd[4];?>">
			<input type="hidden" name="acao" value="<?=$acao;?>">
			<center><input type="submit" name="dd10" value="Confirmar cancelamento do Plano de Aluno"></center>
			</form>
			<?
			echo '</TD></TR>';
			}

		if (($err == 0) and (strlen($dd[10]) > 0))
			{
			$sql = "update ".$tabela." set doc_status = 'X' ";
			$sql .= " where doc_protocolo = '".$dd[1]."' and doc_status <> 'X' ";
			$rlt = db_query($sql);
			echo '<TR><TD colspan="3"><center><B><font color=green>Cancelamento realizado com sucesso!</font></B></center></TD></TR>';

			}
		echo '</table>';
		}
require("foot.php");	?>