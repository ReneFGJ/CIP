<?
$sa = '';
$sb = '';
$fl = 0;
$sql = "select * from ".$tdoco." ";
$sql .= " inner join (select * from ".$ged_files." ";
$sql .= " where pl_codigo = '".trim($proto_file)."') as ged on pl_tp_doc = sdo_codigo ";
if (strlen($tipo_doc) > 0)
	{
	$sql .= " where sdo_codigo = '".$tipo_doc."' ";
	}
//echo $sql;
$prrlt = db_query($sql);
//$s ='';
$obr = 0;
$ane = 0;
$atot = 0;
$link_add = "http://www2.pucpr.br/reol/pibic/";
while ($rpline = db_read($prrlt))
	{
	$fl++;
	$dd0 = $rpline['id_pl'];
	$dd1 = trim($rpline['sdo_codigo']);;
	$chksun = md5($dd0.$dd1.'448545');
	$ob = $rpline['sdo_obrigatorio'];
	$link = '<A HREF="'.$link_add.'download.php?dd0='.$dd0.'&dd1='.$dd1.'&dd10='.$proto_file.'&dd2='.$chksun.'" target="new_pibic">';

	$sa .= '<TR class="lt0">';
	$sa .= '<TD align="right">';
	$sa .= $rpline['sdo_descricao'];
	$file = trim($rpline['pl_filename']);
//	$s .= '['.$file;
//	print_r($rpline);
	if (strlen($file) > 0)
		{
		$atot++;
		if ($ob == 1) { $ane++; }
		$sa .= '<TD colspan="1">'.$link.'<font class="lt2"><font color="blue">';
		$sa .= trim($rpline['pl_texto']);
		$sa .= '&nbsp;('.trim($rpline['pl_type']).')</A>';
		}	
	}

if (strlen($user_nivel) >= 9)
	{
	$dd0 = $proto_file;
	$dd1 = '00004';
	$chksun = md5($dd0.$dd1.'448545');
	$link = '<BR><A HREF="javascript:newxy('.chr(39).'../pibic/ged_upload.php?dd0='.$dd0.'&dd1='.$dd1.'&dd2='.$chksun.chr(39).',500,300);">';
	$sa .= $link.'Anexar arquivo</a>';
	}

if ((strlen($sa) > 0) and ($atot > 0))
	{
	$sb .= $sa;
	}

?>
