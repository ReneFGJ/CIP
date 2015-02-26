<?

/////////////////////////////////////////// busca pareceristas
//$sql = "delete from pibic_parecer_enviado";
//$qrlt = db_query($sql);

$qsql = "select * from pareceristas_area ";
$qsql .= "inner join pareceristas on us_codigo = pa_parecerista ";
$qsql .= "inner join ajax_areadoconhecimento on a_codigo = pa_area ";
$qsql .= "inner join instituicoes on us_instituicao = inst_codigo ";
$qsql .= "left join (select count(*) as total,pp_avaliador from pibic_parecer_enviado where pp_ano = '".date("Y")."'  group by pp_avaliador) as avaliador on pp_avaliador = pa_parecerista ";
$qsql .= "where (a_cnpq like '".substr($ar[0],0,5)."%' ";
if (strlen(trim($ar[1])) > 4) { $qsql .= " or  a_cnpq like '".substr($ar[1],0,9)."%' "; }
if (strlen(trim($ar[1])) > 4) {$qsql .= " or  a_cnpq like '".substr($ar[1],0,4)."%' "; }
$qsql .= ") ";
$qsql .= " and us_ativo = 1 ";
$qsql .= " and us_instituicao = '0000455' ";
$qsql .= " and us_journal_id = 20 ";
$qsql .= "order by us_nome,a_cnpq ";


$qrlt = db_query($qsql);
$sp = '<TR><TD class="lt3" colspan="5" align="center"><HR>PROFESSORES LOCAIS<HR></TD></TR>';
while ($qline = db_read($qrlt))
	{
	$se = '';
	$chk = '';
	if ($dd[21] == trim($qline['us_codigo'])) { $chk = "selected"; }
	$area = trim($qline['a_cnpq']);
	if ($area == trim(substr($ar[1],0,12))) { $se = '<B>'; }
	if ($area == trim(substr($ar[0],0,12))) { $se = '<B>'; }
//	echo '<BR>'.UpperCaseSql(trim($projeto_autor));
//	echo '<BR>'.UpperCaseSql(trim($qline['us_nome']));
	
	if (UpperCaseSql(trim($projeto_autor)) == UpperCaseSql(trim($qline['us_nome'])))
		{ $se .= '<Font color="red">'; }
	$sp .= '<TR>';
	$sp .= '<TD>';
	$sp .= '<input type="radio" name="dd22" value="'.$qline['us_codigo'].'" '.$chk.'>';
	$sp .= '&nbsp;';
	$sp .= $qline['total'];	
	$sp .= '<TD>';
	$sp .= $se;
	$sp .= '<A HREF="avaliado.php?dd0='.$qline['id_us'].'">';
	$sp .= trim($qline['us_nome']);
	$sp .= ' <font color=blue >('.trim($qline['us_bolsista']).')</font>';
	$sp .= '</a>';
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
?>