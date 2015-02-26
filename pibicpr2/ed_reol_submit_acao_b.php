<?
if ($status == 'B')
{

$sql = "select * from ".$tabela2." ";
$sql .= "where spc_projeto = '".strzero($dd[0],7)."' and ";
$sql .= " (spc_codigo ='00052' or spc_codigo = '00060' or spc_codigo = '00429' or ";
$sql .= " spc_codigo = '00430' or spc_codigo = '00648' or spc_codigo = '00649')";
$irlt = db_query($sql);
$areas = array();
$sc .= '<TR><TD colspan="5"><HR></TD></TR>';
$sc .= '<TR class="lt1"><TD colspan="5">';
$ar = array();
while ($iline = db_read($irlt))
	{
	array_push($ar,trim($iline['spc_content']));
	$sc .=  trim($iline['spc_content']).'<BR>';
	}
$sc .= '<TR><TD colspan="5"><HR></TD></TR>';
if (strlen($ar[0]) == '') {$ar[0] = 'XXXX'; }
if (strlen($ar[1]) == '') {$ar[1] = 'XXXX'; }

/////////////////////////////////////////// busca pareceristas

$qsql = "select * from pareceristas_area ";
$qsql .= "inner join pareceristas on us_codigo = pa_parecerista ";
$qsql .= "inner join ajax_areadoconhecimento on a_codigo = pa_area ";
$qsql .= "inner join instituicoes on us_instituicao = inst_codigo ";
$qsql .= "left join (select count(*) as total,pp_avaliador from pibic_parecer_enviado where pp_ano = '".date("Y")."' group by pp_avaliador) as avaliador ";
$qsql .= "on pp_avaliador = pa_parecerista ";
$qsql .= "where (a_cnpq like '".substr($ar[0],0,5)."%' ";
if (strlen(trim($ar[1])) > 4) { $qsql .= " or  a_cnpq like '".substr($ar[1],0,9)."%' "; }
if (strlen(trim($ar[1])) > 4) {$qsql .= " or  a_cnpq like '".substr($ar[1],0,4)."%' "; }
$qsql .= ") ";
$qsql .= " and us_ativo = 1 ";
$qsql .= " and (us_instituicao <> '0000232' and us_instituicao <> '0000455' )";
$qsql .= " and us_aceito = 1 ";
$qsql .= " and us_journal_id = 20 ";
$qsql .= "order by us_nome,a_cnpq ";

$qrlt = db_query($qsql);
$sp = '<TR><TD class="lt3" colspan="5" align="center">PARECERISTA EXTERNO<HR></TD></TR>';

while ($qline = db_read($qrlt))
	{
	$se = '';
	$chk = '';
	if ($dd[20] == trim($qline['us_codigo'])) { $chk = "selected"; }
	$area = trim($qline['a_cnpq']);
	if ($area == trim(substr($ar[1],0,12))) { $se = '<B>'; }
	if ($area == trim(substr($ar[0],0,12))) { $se = '<B>'; }
	$sp .= '<TR>';
	$sp .= '<TD>';
	$sp .= '<input type="radio" name="dd20" value="'.$qline['us_codigo'].'" '.$chk.'>';
	$sp .= '&nbsp;';
	$sp .= $qline['total'];
	$sp .= '<TD>';
	$sp .= $se;
	$sp .= trim($qline['us_nome']);
	$sp .= ' <font color=blue >('.trim($qline['us_bolsista']).')</font>';
	$sp .= '<TD>';
	$sp .= $se;
	$sp .= trim($qline['inst_abreviatura']);
	$sp .= '<TD>';
	$sp .= $se;
	$sp .= trim($qline['a_descricao']);
	$sp .= '<TD>';
	$sp .= $se;
	$sp .= $area;
	$sp .= '</TD></TR>';
	}
	
	$sp = '<TR><TD colspan="4"><table width="'.$tab_max.'" class="lt1">'.$sp.'</table>';
	$sc .= $sp;

require('ed_reol_submit_acao_b_local.php');
}
?>