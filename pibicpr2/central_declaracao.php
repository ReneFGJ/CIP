<?
require("cab_popup.php");
require($include.'sisdoc_email.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');

$sql = "select * from semic_declaracoes ";
$sql .= " where dcl_tipo = '".$dd[1]."' ";
$sql .= " and dcl_ref = '".$dd[0]."' ";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
		$texto = $line['dcl_texto'];
		$id = $line['id_dcl'];
		$msg = '2º via impressa em '.date("Y/m/h H:i");
	} else {
		if ($dd[1] == 'tp01')
		{
		$sql = "select * from semic_avaliacao ";
		$sql .= "where pp_ref = '".$dd[0]."'";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$ref = 'dc_al_'.trim($line['pp_tipo']);
			$nome = $line['pp_aluno_nome'];
			$orie = $line['pp_orientador_nome'];
			$titu = $line['pp_titulo'];
			$tipo = $line['pp_tipo'];
			$zref = trim($line['pp_ref']);
			}
		}
		
		if ($dd[1] == 'tp02')
		{
		$tsql = "select * from semic_eventos_aluno left join pibic_aluno on pa_cracha = ea_cracha left join semic_eventos on ea_bardcod = ev_bardcod ";
		$tsql .= "where id_ea = '".$dd[0]."'";
		$rlt = db_query($tsql);
		if ($line = db_read($rlt))
			{
			$cracha = $line['ea_cracha'];
			$nome = trim($line['pa_nome']);
			if (strlen($nome) == 0)
				{
				require("ferramentas_alunos_busca.php");
				$rlt = db_query($tsql);
				$line = db_read($rlt);
				}			
			$cracha = $line['ea_cracha'];
			$nome = trim($line['pa_nome']);
			$titu = $line['ev_descricao'];
			$tipo = $line['pp_tipo'];
			$zref = trim($line['ea_bardcod']);
			$dia = $line['ea_data'];
			$dia = substr($dia,6,2).' de '.nomemes(intval(substr($dia,4,2))).' de '.substr($dia,0,4);
			$horas = $line['ev_horas'];
			}
			$ref = 'dc_al_oral';
			
			if (strlen($nome) == 0)
				{
				}
		}		
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