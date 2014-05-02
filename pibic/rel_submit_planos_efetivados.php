<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_debug.php");
$tabela = "pibic_bolsa_contempladas";

$sql = "select max(pee_edital) as edital from pibic_edital";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$edital = strzero($line['edital'],4);
	}
	
///////////////////////////// NOVO QUERY
///////////////////////////////////////////////////////////////////////////////
$sql = "select * from (";	
$sql .= "select avg(pee_total) as pee_total, pp_cracha,pee_aluno,";
$sql .= " pee_protocolo_mae,pee_icv, doc_area, pa_nome, pa_bolsa, pa_bolsa_anterior, ";
$sql .= " pee_protocolo, ap_tit_titulo, pp_nome, pp_ss, pp_prod, doc_1_titulo ";
$sql .= " from pibic_edital ";
$sql .= " inner join pibic_aluno on pa_cracha = pee_aluno ";
$sql .= " inner join pibic_submit_documento on doc_protocolo = pee_protocolo ";
$sql .= " inner join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " inner join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where pee_edital = ".$edital."";
$sql .= " and pee_aluno <> '' ";
$sql .= " group by ";
$sql .= " pee_protocolo_mae, pee_icv,pa_nome, pa_bolsa, pa_bolsa_anterior, pp_cracha,pee_aluno,";
$sql .= " pee_protocolo, ap_tit_titulo, pp_nome, pp_ss, pp_prod, doc_area, doc_1_titulo ";
$sql .= ") as tabela ";
$sql .= " left join pibic_bolsa on pee_aluno = pb_aluno and pb_ativo = 1 ";
//$sql .= " and pp_ano = '".date("Y")."' ";
$sql .= " where (pb_tipo = '".$dd[0]."') "; 

$sql .= " order by pp_nome  ";

$rlt = db_query($sql);

$sz = "";
$sc = "";
$sp = "";
$tot0 = 0;
$tot1 = 0;
$tot2 = 0;
while ($line = db_read($rlt))
	{
//	print_r($line);
//	echo '<HR>';
//	exit;
	$link = '<A HREF="pibic_bolsas_contempladas.php?dd0='.$line['id_pb'].'" target="_new">';
	$tot2++;
	$centro = $line['pa_centro'];
	$curso = $line['pa_curso'];
	$prof  = $line['pp_cracha'];
	$tipo = $line['pb_tipo'];
	$doc_protocolo = $line['pb_protocolo'];
	
	if ($tipo == 'F') { $tipo_d = "Fundação Araucária"; }
	if ($tipo == 'C') { $tipo_d = "CNPq"; }
	if ($tipo == 'P') { $tipo_d = "PUCPR"; }
	if ($tipo == 'I') { $tipo_d = "ICV"; }
	if ($tipo == 'A') { $tipo_d = "Qualificado"; }
//	if ($tipo == 'F') { $tipo_d = "Fundação Araucária"; }

	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD>'.$tot2;
	$sx .= '<TD>';
	$sx .= trim($line['pb_protocolo']);
	$sx .= '<TD>';
	$sx .= trim($line['pp_nome']);
	$sx .= '<TD>';
	$sx .= trim($line['pa_nome']);
	$sx .= '<TD>';
	$sx .= trim($line['pb_tipo']);
	$sx .= '<TD align="center">';
	$data = stodbr($line['pb_ativacao']);
	if ($data == '01/01/1900') { $data = '-'; }
	$sx .= $data;
	$sx .= '</TR>';

	}

echo '<CENTER><H2>'.$tipo_d.'</H2></CENTER>';
echo '<table border="0" width="'.$tab_max.'" align="center" class="lt0">';
echo '<TR><TH>pos.</TH><TH>protocolo</TH><TH>Professor(a)</TH><TH>Aluno</TH><TH>T</TH><TH>Efetivado</TH></TR>';
echo $sx;
echo '</table>';
echo $tot2;
require("foot.php");	
?>