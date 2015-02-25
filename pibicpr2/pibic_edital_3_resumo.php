<?
$cps = "pbt_descricao, pb_tipo, doc_area, count(*) as total ";
$sql = "select ".$cps." from pibic_submit_documento ";
$sql .= " inner join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " inner join pibic_aluno on pa_cracha = doc_aluno ";
$sql .= " inner join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " inner join pibic_bolsa on (doc_protocolo = pb_protocolo) ";
$sql .= " inner join pibic_bolsa_tipo on (pb_tipo = pbt_codigo) ";
$sql .= " where doc_ano = '".date("Y")."' ";
$sql .= " and doc_edital = '".$dtipo."' ";
$sql .= " and (doc_protocolo <> doc_protocolo_mae) ";
if (strlen($area) > 0) { $sql .= " and doc_area = '".$area."' "; }
$sql .= " and (doc_status <> 'X' and doc_status <> '@' ) ";
$sql .= " and doc_nota > 10 ";
$sql .= " and pb_tipo <> '' ";
$sql .= " group by pb_tipo, doc_area, pbt_descricao ";
$sql .= " order by doc_area, pb_tipo ";
$rlt = db_query($sql);

$sq = '';
$xa = "X";
$tot = 0;
$toa = 0;

while ($line = db_read($rlt))
	{
	$sqt = trim($line['pb_tipo']);
	$xb = trim($line['doc_area']);
	if ($xb != $xa) 
		{ 
		if ($toa > 0)
			{
			$sq .= '<TR><TD colspan="12" align="right">Total de bolsas '.$toa.'</TD>';
			$toa = 0;
			}
		$sq .= '<TR><TD>'.$xb.'</TD>'; $xa = $xb; $ta = 0;
		}
		
	/* Imagens */
	$bolsa_ind = trim($line['pb_tipo']);
	if (strlen($bolsa_ind) > 0)
		{ $bolsa_ind_img = '<IMG SRC="img/logo_bolsa_'.$bolsa_ind.'.png" border=0>'; } else
		{ $bolsa_ind_img = '-'; }
		
	$sq .='<TD>'.$bolsa_ind_img.'(<B>'.$line['total'].'</B>) - '.$line['pbt_descricao'].'</TD>';
	
	if (($line['pb_tipo'] == 'B') or ($line['pb_tipo'] == 'O') or ($line['pb_tipo'] == 'G') or ($line['pb_tipo'] == 'F')
		 or ($line['pb_tipo'] == 'V') or ($line['pb_tipo'] == 'P')  or ($line['pb_tipo'] == 'C'))
		{
		$toa = $toa + $line['total'];
		$tot = $tot + $line['total'];
		}
	}
	if ($toa > 0)
		{
		$sq .= '<TR><TD colspan="12" align="right">Total de bolsas '.$toa.'</TD>';
		$toa = 0;
		}
	
?>
<TABLE class="lt1" border="1" width="100%">
<TR><TD colspan="10" align="center"><B><?=$tot;?> Bolsas Distribuídas</B></TD></TR>
<?=$sq;?>
</TABLE>
