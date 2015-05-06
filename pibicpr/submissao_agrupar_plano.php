<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$S8','','Protocolo (para cancelar)',True,True,''));
array_push($cp,array('$S8','','Agrupar em (protocolo ativo)',True,True,''));
echo '<CENTER><font class=lt5>Agrupar protocolos com o mesmo nome</font></CENTER>';
?><TABLE width="500" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE><?	

$tabela = "pibic_submit_documento";
/////////////////////////////////////////////////////////////////// Relatório Parcial
if ($saved > 0)
		{
		echo '<table width="'.$tab_max.'">';
		$sql = "select * from $tabela where doc_protocolo_mae = '".$dd[1]."' ";
		$rlt = db_query($sql);
		$line = db_read($rlt);
				
		$tit_1 = trim(uppercaseSQL($line['doc_1_titulo']));
		$pro_1 = $line['doc_autor_principal'];
		$edi_1 = $line['doc_edital'];
		$ano_1 = $line['doc_ano'];
		$sta_1 = trim($line['doc_status']);
		$mae_1 = trim($line['doc_protocolo_mae']);
		

		$sql = "select * from $tabela where doc_protocolo_mae = '".$dd[2]."' ";
		$rlt = db_query($sql);
		$line = db_read($rlt);
				
		$tit_2 = trim(uppercaseSQL($line['doc_1_titulo']));
		$pro_2 = $line['doc_autor_principal'];
		$edi_2 = $line['doc_edital'];
		$ano_2 = $line['doc_ano'];
		$sta_2 = trim($line['doc_status']);
		$mae_2 = trim($line['doc_protocolo_mae']);
		
		///////////////////// Pontos de verificação (Check-list)
		$err = 0;
		echo '<tr><TH colspan="3" class="lt4">Agrupar planos de aluno do protocolo '.$dd[1].' para o '.$dd[2].'</TH></tr>';
		/// Ponto 1
		echo '<tr '.coluna().'><TD width="20">1</TD><td>Títulos dos planos diferentes</td>';
		if ($tit_1 != $tit_2)
			{ echo '<TD><font color=green>OK</TD>'; } else { echo '<TD><font color=red>Não OK!</font></TD>'; $err++; }

		/// Ponto 2
		echo '<tr '.coluna().'><TD width="20">1</TD><td>Mesmo professor</td>';
		if ($pro_1 == $pro_2)
			{ echo '<TD><font color=green>OK</TD>'; } else { echo '<TD><font color=red>Não OK!</font></TD>'; $err++; }

		/// Ponto 3
		echo '<tr '.coluna().'><TD width="20">1</TD><td>Mesmo Edital</td>';
		if ($edi_1 == $edi_2)
			{ echo '<TD><font color=green>OK</TD>'; } else { echo '<TD><font color=red>Não OK!</font></TD>'; $err++; }

		/// Ponto 4
		echo '<tr '.coluna().'><TD width="20">1</TD><td>Mesmo Ano de submissão</td>';
		if ($ano_1 == $ano_2)
			{ echo '<TD><font color=green>OK</TD>'; } else { echo '<TD><font color=red>Não OK!</font></TD>'; $err++; }

		/// Ponto 5
		echo '<tr '.coluna().'><TD width="20">1</TD><td>Mesmo status</td>';
		if ($sta_1 == $sta_2)
			{ echo '<TD><font color=green>OK</TD>'; } else { echo '<TD><font color=red>Não OK!</font></TD>'; $err++; }

		/// Ponto 6
		echo '<tr '.coluna().'><TD width="20">1</TD><td>Status em do projeto em (A, B, C ou D)? ('.$sta_1.'-'.$sta_2.')</td>';
		if (($sta_1 == 'A') or ($sta_1 == 'B') or ($sta_1 == 'C') or ($sta_1 == 'D'))
			{ echo '<TD><font color=green>OK</TD>'; } else { echo '<TD><font color=red>Não OK!</font></TD>'; $err++; }
			
		if (($err == 0) and (strlen($dd[10]) == 0))
			{
			echo '<TR><TD colspan="3">';
			?>
			<form method="post" action="submissao_agrupar_plano.php">
			<input type="hidden" name="dd0" value="<?=$dd[0];?>">
			<input type="hidden" name="dd1" value="<?=$dd[1];?>">
			<input type="hidden" name="dd2" value="<?=$dd[2];?>">
			<input type="hidden" name="dd3" value="<?=$dd[3];?>">
			<input type="hidden" name="dd4" value="<?=$dd[4];?>">
			<input type="hidden" name="acao" value="<?=$acao;?>">
			<center><input type="submit" name="dd10" value="Confirmar Agrupamento de Planos de Alunos"></center>
			</form>
			<?
			echo '</TD></TR>';
			}

		if (($err == 0) and (strlen($dd[10]) > 0))
			{
			$sql = "update ".$tabela." set doc_protocolo_mae = '".$dd[2]."' ";
			$sql .= " where doc_protocolo_mae = '".$dd[1]."' ";
			$rlt = db_query($sql);

			$sql = "update ".$tabela." set doc_status = 'X' ";
			$sql .= " where doc_protocolo_mae = '".$dd[1]."' and doc_status <> 'X' ";
			$rlt = db_query($sql);
			
			$sql = "update pibic_projetos set pj_status = 'X' ";
			$sql .= " where pj_codigo = '".$dd[1]."' ";
			$rlt = db_query($sql);
						
			echo '<TR><TD colspan="3"><center><B><font color=green>Agrupamento realizado com sucesso!</font></B></center></TD></TR>';

			}
		echo '</table>';
		}
require("foot.php");	?>