<?
echo '========================';
require($include."sisdoc_data.php");
$sa = '';
$sb = '';
$fl = 0;
//$sql = "update submit_documentos_obrigatorio set sdo_codigo = 'RPARC' where sdo_codigo = '00019'";
//$prrlt = db_query($sql);

$sql = "";
$sql = "select * from submit_documentos_obrigatorio ";
$sql .= " inner join (";
$sql .= " select * from pibic_ged_files ";
$sql .= " where pl_codigo = '".trim($protocolo)."' or  pl_codigo = '".trim($protocolom)."'";
$sql .= " or pl_codigo = 'X".substr(trim($protocolo),1,6)."' or  pl_codigo = 'X".substr(trim($protocolom),1,6)."'";
$sql .= ") as ged on pl_tp_doc = sdo_codigo ";
$sql .= " order by pl_data desc ";

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
	$tipo = trim($rpline['sdo_codigo']);
	if (strlen($file) > 0)
		{
		$atot++;
		if ($ob == 1) { $ane++; }
		$sa .= '<TD colspan="1">'.$link.'<font class="lt2"><font color="blue">';
		if ($tipo = 'RPARC') { $tipo = '<B>'; }
		$sa .= trim($rpline['pl_texto']);
		$sa .= '&nbsp;('.trim($rpline['pl_type']).')</B></A>';
		}	
	$sa .= '<TD align="right" class="lt1">';
	$sa .= stodbr($rpline['pl_data']);
	}
?>
<TR><TH colspan="3" bgcolor="#E6E3FB">Arquivos disponíveis</TD></TR>
<?=$sa;?>
<TR><TD colspan="3">
<BR><BR>
