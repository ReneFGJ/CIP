<?
$fl = 0;
$sql = "select * from ".$tdoco." ";
$sql .= " left join (select * from ".$ged_files." ";
$sql .= " where pl_codigo = '".trim($protocolo)."') as ged on pl_tp_doc = sdo_codigo ";
if (strlen($tipo_doc) > 0)
	{
	$sql .= " where sdo_codigo = '".$tipo_doc."' ";
	}
$rlt = db_query($sql);
$s ='';
$obr = 0;
$ane = 0;
$atot = 0;
while ($line = db_read($rlt))
	{
	$fl++;
	$dd0 = $line['id_pl'];
	$dd1 = $line['sdo_codigo'];
	$chksun = md5($dd0.$dd1.'448545');
	$ob = $line['sdo_obrigatorio'];
	$link = '<A HREF="javascript:newxy('.chr(39).$link_add.'download.php?dd0='.$dd0.'&dd1='.$dd1.'&dd2='.$chksun.chr(39).',500,300);">';

	$s .= '<TR>';
	$s .= '<TD>';
	$s .= $line['sdo_descricao'];
	$file = trim($line['pl_filename']);
//	$s .= '['.$file;
//	print_r($line);
	if (strlen($file) > 0)
		{
		$atot++;
		if ($ob == 1) { $ane++; }
		$s .= '<TR><TD colspan="5">'.$link.'&nbsp;&nbsp;&nbsp;<font color="blue">';
		$s .= trim($line['pl_texto']);
		$s .= '&nbsp;('.trim($line['pl_type']).')</A>';
		}		
	}

if ((strlen($s) > 0) and ($atot > 0))
	{
	echo '<TABLE width="100%"  class="lt1">';
	echo '<TR>';
	echo '<TH>Tipo Documento';
	echo $s;
	echo '</TABLE>';
	}

$s = '';

?>
