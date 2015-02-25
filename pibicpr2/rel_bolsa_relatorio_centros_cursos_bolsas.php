<?
require("cab.php");

if (strlen($dd[2]) > 0) { $pibic_ano = $dd[2]; } else { $pibic_ano = (date("Y")-1); }
	
$tabela = "pibic_bolsa_contempladas";

$sql = "select pb_tipo, pbt_descricao, count(*) as total, pibic_aluno.pa_centro as pa_centro, ";
$sql .= " pibic_aluno.pa_curso as pa_curso from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
//$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
//$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= "where pb_ano = '".$pibic_ano."' ";
if (strlen($dd[0]) > 0)
	{ $sql .= " and (pb_tipo = '".$dd[0]."' )"; }
$sql .= " and pb_status = 'A' "; 	
$sql .= " group by pa_centro, pb_tipo, pbt_descricao, pb_tipo, pa_curso ";
$sql .= " order by pa_centro, pbt_descricao, pa_curso"; 

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
$tot3 = 0;
$tot4 = 0;
$cc = "X";
$cb = "X";
while ($line = db_read($rlt))
	{

	//////////////////////////////// CENTRO
	$cx = trim($line['pa_centro']);
	if ($cc != $cx)
		{
		if ($tot3 > 0)
			{
			$sx .= '<TR bgcolor="#FFFFFF">';
			$sx .= '<TD colspan="4" class="lt1" align="right"><I>sub-total do centro '.$tot3.'</TD>';
			$sx .= '</TR>';
			$tot3 = 0;
			}
		$sx .= '<TR bgcolor="#ffe1e1">';
		$sx .= '<TD colspan="4" class="lt2"><B>'.$line['pa_centro'].'</TD>';
		$sx .= '</TR>';
		$cc = $cx;
		}

	//////////////////////////////// BOLSA
	$cx = trim($line['pb_tipo']);
	if ($cb != $cx)
		{
		$sx .= '<TR bgcolor="#ffe1e1"><TD>&nbsp;</TD>';
		$sx .= '<TD colspan="3" class="lt1"><B><I>'.$line['pbt_descricao'].'</I></B></TD>';
		$sx .= '</TR>';
		$cb = $cx;
		}


	$tot3 = $tot3 + $line['total'];
	$tot1 = $tot1 + $line['total'];
	$tot4 = $tot4 + $line['total'];
	$tot2 = $tot2 + 1;

	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD width="10">&nbsp;</TD>';
	$sx .= '<TD width="10">&nbsp;</TD>';
	$sx .= '<TD colspan="1">'.$line['pa_curso'].'</TD>';
	$sx .= '<TD align="right">'.$line['total'].'</TD>';
	$sx .= '</TR>';
	
	$tot0++;
	}
if ($tot3 > 0)
	{
	$sx .= '<TR bgcolor="#ffe1e1">';
	$sx .= '<TD colspan="3" align="right">sub-total do centro '.$tot3.'</TD>';
	$sx .= '</TR>';
	$tot3 = 0;
	}

echo '<H2>Relatório de Bolsas '.$pibic_ano.'</H2>';

echo '<table border="0" width="'.$tab_max.'" align="center" class="lt0">';
echo '<TR><TH>Centro</TH><TH colspan="2">Curso</TH><TH>Total</TH></TR>';
echo $sx;
echo '<TR><TH colspan="3">Total de '.$tot2.' cursos com '.$tot1.' estudantes de IC.</TH></TR>';
echo '</table>';

require("foot.php");	
?>