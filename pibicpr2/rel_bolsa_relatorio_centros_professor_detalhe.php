<?
require("cab.php");

if (strlen($dd[2]) > 0) { $pibic_ano = $dd[2]; } else { $pibic_ano = (date("Y")-1); }
	
$tabela = "pibic_bolsa_contempladas";

$sql = "select pbt_descricao, count(*) as total, pibic_professor.pp_centro as pa_centro, pp_nome from pibic_bolsa_contempladas ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
//$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
//$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= "where pb_ano = '".$pibic_ano."' ";
if (strlen($dd[0]) > 0)
	{ $sql .= " and (pb_tipo = '".$dd[0]."' )"; }
if (strlen($dd[3]) > 0) 
	{ $sql .= " and (pibic_professor.pp_centro like '%".$dd[3]."%')"; }
$sql .= " and pb_status <> 'C' "; 	
$sql .= " group by pa_centro, pp_nome, pbt_descricao";
//$sql = "order by pa_centro"; 

echo '<TT><BR><BR>';
$rlt = db_query($sql);

$sz = "";
$sc = "";
$sp = "";
$tot0 = 0;
$tot1 = 0;
$tot2 = 0;

$sx = '';
$tot1 = 0;
$tot2 = 0;
while ($line = db_read($rlt))
	{
	$tot1 = $tot1 + $line['total'];
	$tot2 = $tot2 + 1;
	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD>'.$line['pa_centro'].'</TD>';
	$sx .= '<TD>'.$line['pp_nome'].'</TD>';
	$sx .= '<TD>'.$line['pbt_descricao'];
	$sx .= '<TD align="right">'.$line['total'].'</TD>';
	$sx .= '</TR>';
	$tot0++;
	}

echo '<H2>Relatório de Bolsas '.$pibic_ano.'</H2>';

echo '<table border="0" width="704" align="center" class="lt0">';
echo '<TR><TH>Centro</TH><TH>Orientador<TH>Modalidade<TH>Total</TH></TR>';
echo $sx;
echo '<TR><TH colspan="2">Total de '.$tot2.' centros com '.$tot1.' estudantes de IC.</TH></TR>';
echo '</table>';

echo '<BR><BR><BR>';
require("foot.php");	
?>