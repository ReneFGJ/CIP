<?
while ($line = db_read($rlt))
	{
	$ano = $line['doc_ano'];
	if ($xano <> $ano)
		{
		$sx .= '<TR><TD colspan="5" class="lt5">'.$ano.'</TD></TR>';
		$xano = $ano;
		}
	if ($sta != trim($line['pp_centro']))
		{
		$sta = trim($line['pp_centro']);
		$stb = '&nbsp;'.trim($line['centro_nome']);
		$sx .= '<TR><TD colspan="3" class="lt4">'.$sta.$stb.'</TD></TR>';
		}
	$sx .= '<TR>';
	$sx .= '<TD>';
	$sx .= $line['doc_edital'].' - ';
	$sx .= '<a href="submissao_detalhe.php?dd4='.trim($line['doc_ano']).'&dd5='.trim($line['doc_status']).'&dd6='.trim($line['doc_tipo']).'&dd3='.$line['pp_centro'].'">' . $line['sp_descricao'] .'</A>';
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