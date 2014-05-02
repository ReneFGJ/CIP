<?
$qsql = "select * from pibic_submit_documento where doc_status='@' ";
$qsql .= "and doc_tipo='00041' ";
$qsql .= "and doc_autor_principal='".$id_pesq."'";

$rrlt = db_query($qsql);
$so = '<TR><TD class="lt0" align="right">Projeto principal</TD><TD class="lt1">';

while ($line = db_read($rrlt))
	{
	$chk = '';
	if ($dd[$dx] == strzero($line['id_doc'],7)) { $chk = 'checked'; }
	$so .= '<input type="radio" name="dd'.$dx.'" value="'.strzero($line['id_doc'],7).'" '.$chk.'>';
	$so .= trim($line['doc_1_titulo']);
	$so .= '<BR>';
	}
$so .= '</TD></TR>';
?>