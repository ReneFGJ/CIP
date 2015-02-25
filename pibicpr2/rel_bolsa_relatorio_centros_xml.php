<?
require("db.php");
require($include."sisdoc_data.php");
$tabela = "pibic_bolsa_contempladas";

if (strlen($dd[2]) > 0) { $pibic_ano = $dd[2]; } else { $pibic_ano = (date("Y")-1); }

 $file='relatorio de pibic - aluno - bolsa '.date("d-m-Y").'.xls';
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment;filename=".$file );
  header('Pragma: no-cache');
  header('Expires: 0');
	
$tabela = "pibic_bolsa_contempladas";

$sql = "select count(*) as total, pibic_aluno.pa_centro as pa_centro from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
//$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
//$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= "where pb_ano = '".$pibic_ano."' ";
if (strlen($dd[0]) > 0)
	{ $sql .= " and (pb_tipo = '".$dd[0]."' )"; }
$sql .= " and pb_status = 'A' "; 	
$sql .= " group by pa_centro";
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
	$sx .= '<TR>';
	$sx .= '<TD>'.$line['pa_centro'].'</TD>';
	$sx .= '<TD align="right">'.$line['total'].'</TD>';
	$sx .= '</TR>';
	$tot0++;
	$tot1++;
	}

echo '<H2>Relatório de Bolsas '.$pibic_ano.'</H2>';

echo '<table border="0" width="650" align="center" class="lt0">';
echo '<TR><TH>Centro</TH><TH>Total</TH></TR>';
echo $sx;
echo '<TR><TH colspan="2" class="lt1">Total de '.$tot2.' centros com '.$tot1.' estudantes de IC.</TH></TR>';
echo '</table>';


?>