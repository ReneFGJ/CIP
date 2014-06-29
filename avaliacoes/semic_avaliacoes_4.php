<?
$id = 0;
$rlt = db_query($sql);
$tot = 0;
$sqlu = '';
while ($line = db_read($rlt))
	{
	$tot++;
	$id = strzero($line['id_psa'],5).'-'.dv($line['id_psa']);
	$sx .= '<TR align="center" '.coluna().'>';
	$sx .= '<TD align="left">';
//	$sx .= $line['id_psa'];
	$sx .= $id;
	$sx .= '<TD align="left">';
	$sx .= trim($line['psa_p02']);
	$sx .= '<TD>';
	$sx .= $line['psa_p05'];
	$sx .= '<TD>';
	$sx .= $line['psa_p06'];
	$sx .= '<TD>';
	$sx .= $line['psa_p01'];
	$sx .= '<TD>';
	$sx .= $line['psa_p02'];
	$sx .= '<TD>';
	$sx .= $line['psa_p03'];
	$sx .= '<TD>[';
	$sx .= $line['psa_abe_1'];
	$sx .= ']<TD>';
	$sx .= $line['psa_abe_2'];
	$sx .= '<TD>[';
	$sx .= $line['psa_abe_3'];
	$sx .= ']<TD>';
	if ($line['psa_abe_4'] < 11) 
		{
			 $sx .= '<font color="red">';
			 if ($line['psa_abe_4'] > 0)
			 {
			 	$sqlu .= "update pibic_semic_avaliador set psa_abe_4 = ".($line['psa_abe_4']*10)." where id_psa = ".$line['id_psa'].'; '.chr(13);
			 } 
		}
	$sx .= $line['psa_abe_4'];
	$sx .= '<TD>';
	$sx .= $line['psa_abe_5'];
	$sx .= '<TD>';
	$sx .= $line['psa_abe_6'];
	$sx .= '<TD>=>';
	$sx .= $line['psa_final'];
	$sx .= '<TD>';
	$sx .= $line['psa_checked'];
	$sx .= '</TR>';
	$rr = $line;
	}
if (strlen($sqlu) > 0)
	{
		//echo $sqlu;
		//$rlt = db_query($sqlu);
	}
?>


<table width="100%" align="center" class="lt1">
<TR><TH>Trabalho</TH><TH>Evento</TH><TH>Nota (soma)</TH><TH>Avaliações</TH></TR>
<?=$sx;?>
</table>
Total <?=$tot; ?>
<?

?>