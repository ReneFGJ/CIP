<?
$texto = $id_ic."_PENDE";
$sql = "select * from ".$ic_noticia." where nw_ref = '".$texto."'";
$rrr = db_query($sql);
if ($eline = db_read($rrr))
	{
	$sC = $eline['nw_descricao'];
	$texto = $eline['nw_descricao'];
	$texto = '<TABLE width="'.$tab_max.'"><TR><TD>'.mst($texto).'</TABLE>';
	}
echo $texto;
?>