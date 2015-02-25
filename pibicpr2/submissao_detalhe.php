<?
///////////////// Versao 0.0.1f de 02/08/2008
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_autor.php');
$label = "Artigos submetidos para Análise";
$cpi = "";
$tabela = "submit_documento";
$http_ver = 'ed_reol_submit_article.php';
if (strlen($dd[10]) > 0) { $sub_ano = $dd[10]; } 
else { $sub_ano = (date("Y")-1); }

if ($journal_id=='0000020')
	{
	$tabela = "pibic_projetos";
	$http_ver = 'ed_pibic_submit_article.php';
	}

$sql = "select * from ".$tabela." ";
$sql .= " left join pibic_professor on pj_professor = pp_cracha ";
$sql .= " where pj_status = '".$dd[5]."' ";
if (strlen($dd[3]) > 0)
	{ $sql .= " and pp_centro = '".trim($dd[3])."' "; }
$sql .= " order by pj_titulo ";
echo $sql;

$sx = '';
$nr = 0;
$rlt = db_query($sql);
$cod = "X";
$npa = 'x';
$rep = 0;
while ($line = db_read($rlt))
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
	$sx .= '<TD rowspan="2" align="center">'.$agrupar.'</TD>';
	$sx .= '</TR>';
	
	$sx .= '<TR '.$colx.'><TD></TD><TD colspan="1">';
//	$sx .= $line['doc_autor_principal'];
	$sx .= '&nbsp;&nbsp;&nbsp;&nbsp;'.NBR_autor(trim($line['pp_nome']),7);
	$sx .= '<TD colspan="2" class="lt0"><NOBR>'.$line['doc_edital'].'/'.$line['doc_ano'].'</TD>';
	$sx .= '</TD></TR>'.chr(13).chr(10);
	$proto_02 = $line['doc_protocolo'];
	}

	
?>
<h2>Projetos Submetidos <?=$dd[4];?> [<?=$dd[5];?>] <?=$dd[6];?></h2>
<?
echo '<TABLE width="'.$tab_max.'" align="center" class="lt1">';
echo '<TR><TH>nr</TH><TH>título<TH>prot.</TH><TH>St</TH></TR>';
echo $sx;
echo '</TABLE>';
if ($rep > 0)
	{
	echo 'Repetidos '.$rep;
	}
require("foot.php");	
?>