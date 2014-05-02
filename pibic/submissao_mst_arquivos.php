<?
$sx .= '<fieldset><legend>Arquivos do protolo</legend>';
$sql = "select * from ".$tdoco." ";
$sql .= " left join (select * from ".$ged_files." ";
$sql .= " where pl_codigo = '".trim($protocolo)."') as ged on pl_tp_doc = sdo_codigo ";
$rlt = db_query($sql);

/* Mostra os arquivos */
$sx .= '<TABLE width="100%" class="lt1">';
$sx .= '<TR><TH>Arquivo</TH><TH>Data postagem</TH><TH>Tamanho</TH></TR>';
while ($line = db_read($rlt))
	{
	$fl++;
	/* Cria link para download */
	$dd0 = $line['id_pl'];
	$dd1 = $line['sdo_codigo'];
	$chksun = md5($dd0.$dd1.$secu_main);
	$ob = $line['sdo_obrigatorio'];
	$link = '<A HREF="javascript:newxy('.chr(39).$link_add.'download.php?dd0='.$dd0.'&dd1='.$dd1.'&dd2='.$chksun.chr(39).',500,300);">';

	/* Constroi a tela */
	$file = trim($line['pl_filename']);
	if (strlen($file) > 0)
		{
		$atot++;
		if ($ob == 1) { $ane++; }
		$sx .= '<TR><TD colspan="1">'.$link.'&nbsp;&nbsp;&nbsp;<font color="blue">';
		$sx .= trim($line['pl_texto']);
		$sx .= '&nbsp;('.trim($line['pl_type']).')</A>';
		$sx .= '<TD align="center">'.$link.stodbr($line['pl_data']).' '.$line['pl_hora'].'</TD>';
		$sx .= '<TD align="center">'.$link.number_format($line['pl_size']/1024,1).'k Bytes</TD>';
		}		
	}
$sx .= '</table>';
$sx .= '</fieldset>';
?>