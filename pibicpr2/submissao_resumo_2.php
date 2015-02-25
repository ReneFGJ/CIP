<?
while ($line = db_read($rlt))
	{
	$ano = $line['doc_ano'];
	if ($xano <> $ano)
		{
		$sx .= '<TR><TD colspan="5" class="lt5">'.$ano.'</TD></TR>';
		$xano = $ano;
		}
	if ($sta != trim($line['doc_status']))
		{
		$sta = trim($line['doc_status']);
		if ($sta == '@') { $status = 'Em submissão'; }
		if ($sta == 'A') { $status = 'Submetido'; }
		if ($sta == 'B') { $status = 'Indicar parecerista'; }
		if ($sta == 'C') { $status = 'Com parecerista'; }
		if ($sta == 'D') { $status = 'Parecer Relatado'; }
		if ($sta == 'E') { $status = 'Finalizado'; }
		if ($sta == 'X') { $status = 'Cancelado'; }
		$sx .= '<TR><TD colspan="3" class="lt4">'.$status.'</TD></TR>';
		}
	$sx .= '<TR>';
	$sx .= '<TD>';
	$sx .= $line['doc_edital'].' - ';
	$sx .= '<a href="submissao_detalhe.php?dd4='.trim($line['doc_ano']).'&dd5='.trim($line['doc_status']).'&dd6='.trim($line['doc_tipo']).'&dd7='.trim($line['doc_edital']).'">' . $line['sp_descricao'] .'</A>';
	$sx .= '<TD align="center">';
	$sx .= $line['total'];
	$sx .= '<TD align="center">';
	$sx .= $line['doc_status'];
	$sx .= '</TR>';
	}
	
if (strlen($sx) > 0)
	{
	echo '<font class="lt5">'.$titulo_pg.'</font><BR>';
	echo '<table width="500" class="lt2">';
	echo '<TR><Th>tipo de projeto</Th>';
	echo '<TH>total</TH>';
	echo '<TH>status</TH>';
	echo $sx;
	echo '</table>';
	}
?>