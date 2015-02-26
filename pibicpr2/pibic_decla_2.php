<?
require("cab_popup.php");
require($include.'sisdoc_email.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');

$jid = '20';
if ($dd[2] == '2009') { $jid = '35'; }
$ref = 'dc_al_'.$dd[1].$dd[2];


$sql = "select * from semic_declaracoes ";
$sql .= " where dcl_tipo = '".$dd[1]."' ";
$sql .= " and dcl_ref = '".$ref."' ";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
		$texto = $line['dcl_texto'];
		$id = $line['id_dcl'];
		$msg = '2º via impressa em '.date("Y/m/h H:i");
	} else {
	
	$sql = "select * from pibic_aluno ";
	$sql .= "left join pibic_bolsa_contempladas on pb_aluno = pa_cracha ";
	$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
	$sql .= " where pb_aluno = '".$dd[0]."' ";
	$sql .= " and pb_ano = '".$dd[2]."' ";
	$sql .= " and pb_status <> 'C' ";
	$sql .= " order by pb_ano desc ";
	$rlt = db_query($sql);

	if ($line = db_read($rlt))
		{
		} else {
		$sql = "select * from pibic_aluno ";
		$sql .= " where pa_cracha = '".$dd[0]."' ";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		}

	$orie = $line['pp_nome'];
	$nome = $line['pa_nome'];
	$titu = $line['pb_titulo_projeto'];
	
	if (strlen($ref) > 0)
		{
		$sql = "select * from ic_noticia ";
		$sql .= "where nw_ref = '".$ref."' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$texto = $line['nw_descricao'];
			$titulo = $line['nw_titulo'];
			} else {
				echo 'Não localizado corpo do texto para '.$ref;
				exit;
			}
		}	
	$texto = troca($texto,'$ALUNO',$nome);
	$texto = troca($texto,'$ORIENTADOR',$orie);
	$texto = troca($texto,'$TITULO',$titu);
	$texto = troca($texto,'$REF',$zref);
	$texto = troca($texto,'$DATA',date("d").' de '.nomemes(intval(date("m")))." de ".date("Y").'.');
	$texto = troca($texto,'$DIA',$dia);
	$texto = troca($texto,'$HORAS',trim($horas));

	$sql = "insert into semic_declaracoes ";
	$sql .= "(dcl_texto,dcl_data,dcl_hora,";
	$sql .= "dcl_status,dcl_tipo,dcl_ref) ";
	$sql .= " values ";
	$sql .= "('".$texto."','".date("Ymd")."','".date("H:i")."',";
	$sql .= "'A','".$dd[1]."','".$dd[0]."');";
	$rlt = db_query($sql);
	
	$sql = "select * from semic_declaracoes ";
	$sql .= " where dcl_tipo = '".$dd[1]."' ";
	$sql .= " and dcl_ref = '".$dd[0]."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt)) { $id = $line['id_dcl']; }
	}	
	
echo emailcab($http_local);
$cr = chr(13).chr(10);
$ss = '<style>'.$cr;
$ss .= '.tit {'.$cr;
$ss .= '	font-family: "verdana","ARIAL";'.$cr;
$ss .= '	font-size: 30px;'.$cr;
$ss .= '	font-weight: bolder;'.$cr;
$ss .= '	line-height: 40px;'.$cr;
$ss .= '}'.$cr;
$ss .= '.texto'.$cr;
$ss .= '	{'.$cr;
$ss .= '	font-family: "verdana","ARIAL";'.$cr;
$ss .= '	font-size: 18px;'.$cr;
$ss .= '	line-height: 28px;	'.$cr;
$ss .= '	}'.$cr;
$ss .= '.mini'.$cr;
$ss .= '	{'.$cr;
$ss .= '	font-family: "verdana","ARIAL";'.$cr;
$ss .= '	font-size: 8px;'.$cr;
$ss .= '	line-height: 10px;	'.$cr;
$ss .= '	}	'.$cr;
$ss .= '</style>'.$cr;
$ss .= '<img src="http://www2.pucpr.br/reol/public/'.$jid.'/images/homeHeaderLogoImage.jpg">'.$cr;
$ss .= '<BR>'.$cr;
$ss .= $texto.$cr;
$ss .= '<BR><BR>'.$cr;
$ss .= '<font class="mini">Este documento pode ser autenticado pelo endereço <BR><B>www2.pucpr.br/reol/pibic/declaracao.php</B> ';
$ss .= 'informando o código '.strzero($id,7).'-'.substr(md5($secu.$id),0,5).$cr;

echo $ss.'<BR>'.$msg;
?>