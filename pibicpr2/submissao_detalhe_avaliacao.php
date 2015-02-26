<?
///////////////// Versao 0.0.1f de 02/08/2008
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_autor.php');
$label = "Artigos com uma ou menos avaliações finalizadas";
require('../_class/_class_parecer_pibic.php');
$pb = new parecer_pibic;
$pb->tabela = 'pibic_parecer_'.date("Y");
$sql = "select * from pibic_projetos ";
$sql .= " left join ";
$sql .= " ( select pp_protocolo, count(*) as total from ".$pb->tabela;
$sql .= " where pp_status = 'A' ";
$sql .= " group by pp_protocolo) as total ";
$sql .= " on pj_codigo = pp_protocolo ";
$sql .= " where (pj_status ='C')";
$sql .= " order by pj_codigo ";
$rlt = db_query($sql);

$sql = "";
while ($line = db_read($rlt))
	{
	if ($line['total'] >= 2)
		{
			$sql = "update pibic_projetos set pj_status = 'D' where pj_codigo = '".$line['pp_protocolo']."'; ";
			$sql .= "update pibic_submit_documento set doc_status = 'D' where doc_protocolo_mae = '".$line['pp_protocolo']."' and ((doc_status = 'C') or (doc_status = 'D')); ";
			$rrr = db_query($sql);
			$sql = "";
		}
	if ($line['total'] < 2)
	{
	$link = '<A HREF="http://www2.pucpr.br/reol/pibicpr2/pibic_projetos_detalhes.php?dd0='.$line['id_pj'].'&dd90='.checkpost($line['id_pj']).'" target="new'.date("hims").'"><font class="lt1">';
	$colx = coluna();
	$proto_01 = $line['pj_codigo'];
	$codp = $line['pj_professor'];
	$np = UpperCaseSQL(trim($line['pj_titulo']));
	$np = troca($np,'-','');
	$np = troca($np,' ','');
	
	if ($codp != $cod)
		{ $sx .= '<TR><TD colspan="4" bgcolor="#c0c0c0"></TD></TR>'; $cod = $codp; }
//	print_r($line);
//	exit;
	$nr++;
	$agrupar = '';
	$sx .= '<TR valign="top" '.$colx.'>';
	$sx .= '<TD>'.$nr;
	$sx .= '<TD>';
	$sx .= $link;
	/////////////////////////// título repetido
	if ($npa == $np) 
			{ 
				$sx .= '<font color=red>'; $rep++; 	
				$agrupar = '<A href="submissao_agrupar_plano.php?dd1='.$proto_02.'&dd2='.$proto_01.'&acao=agrupar" target="new_'.date("Ymdhs").'">AGRU-<BR>PAR</A>';
			}
	$npa = $np;
	$sx .= trim($line['pj_titulo']);
	$sx .= '<TD>';
	$sx .= trim($line['pj_codigo']);
	$sx .= '<TD>';
	$sx .= trim($line['pj_status']);
	$sx .= '<TD>';
	$sx .= trim($line['total']);
	$sx .= '</TR>';
	
	$sx .= '<TR '.$colx.'><TD></TD><TD colspan="1">';
//	$sx .= $line['doc_autor_principal'];
	$sx .= '&nbsp;&nbsp;&nbsp;&nbsp;'.NBR_autor(trim($line['pp_nome']),7);
	$sx .= '<TD colspan="2" class="lt0"><NOBR>'.$line['doc_edital'].'/'.$line['doc_ano'].'</TD>';
	$sx .= '</TD></TR>'.chr(13).chr(10);
	$proto_02 = $line['doc_protocolo'];
	}
	}

echo '<table>'.$sx.'</table>';
require("foot.php");	
?>