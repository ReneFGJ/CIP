<?
require("db.php");
require($include."sisdoc_data.php");
$tabela = "pibic_bolsa_contempladas";
$pibic_ano = date("Y");
if (strlen($dd[2]) > 0)
	{ $pibic_ano = $dd[2]; }
	
 $file='relatorio de pibic - aluno - bolsa '.date("d-m-Y").'.xls';
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment;filename=".$file );
  header('Pragma: no-cache');
  header('Expires: 0');

$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
if (strlen($dd[0]) > 0)
	{
		$sql .= " where (pb_tipo = '".$dd[0]."' )";
	} else {
		$sql .= " where (1=1) ";
	}
if (strlen($dd[2]) > 0)
	{ $sql .= " and (doc_ano = '".$dd[2]."' ) "; }
	
$sql .= " and pb_status <> 'C' ";
$sql .= "order by pa_centro, pa_curso, pp_nome";

/** NOVO **/
$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
if (strlen($dd[0]) > 0)
	{
		$sql .= " where (pb_tipo = '".$dd[0]."' )";
	} else {
		$sql .= " where (pb_status <> 'C') ";
	}
	
if (strlen($dd[1]) > 0)
	{
		$sql .= " and pb_status = '".$dd[1]."' ";
	} else {
		$sql .= " and pb_status <> 'C' ";
	}
	
//$sql .= " and pb_data_ativacao > 20080101 ";
//$sql .= " and pb_data = '".$dd[2]."' ";

$sql .= " and pb_ano = '".$pibic_ano."' ";
$sql .= " order by pa_nome, pa_curso";

$rlt = db_query($sql);

$sz = "";
$sc = "";
$sp = "";
$tot0 = 0;
$tot1 = 0;
$tot2 = 0;
while ($line = db_read($rlt))
	{
	$tot2++;
	$centro = $line['pa_centro'];
	$curso = $line['pa_curso'];
	$prof  = $line['pp_cracha'];
	$tipo = $line['pb_tipo'];
	$doc_protocolo = $line['pb_protocolo'];
	if (strpos($curso,'(') > 0) { $curso = substr($curso,0,strpos($curso,'(')); }
	$bolsa = $tipo;
	require("bolsa_tipo.php");
	$tipo_d = $bolsa_nome;
//	if ($tipo == 'F') { $tipo_d = "Fundação Araucária"; }

	$col = '';
	$sx .= '<TR valign="top"><TD>'.$line['pp_nome'];
	$sx .= '<TD>'.$line['pa_cracha'].'</TD>';
	$sx .= "<TD>'".$line['pp_cpf'].'</TD>';
	//print_r($line);
	//exit;
	$sx .= '<TD>';
	$sx .= $line['pb_edital'];
	$sx .= '<TD>';
	$sx .= $line['pb_ano'];
	$sx .= '<TD>';
	$sx .= $line['pa_nome'];
	$sx .= '<TD>'.$line['pp_cracha'];
	$sx .= '<TD>'.$line['pa_pai'];
	$sx .= '/ '.$line['pa_mae'];
	$sx .= "<TD>'";
	$sx .= $line['pa_cpf'];

	$sx .= "<TD>'";
	$sx .= $line['pa_cc_banco'];
	$sx .= "<TD>'";
	$sx .= $line['pa_cc_agencia'];
	$sx .= "<TD>'";
	$sx .= $line['pa_cc_conta'];
	$sx .= "<TD>'";
	$sx .= $line['pa_cc_tipo'];

	$sx .= "<TD>'";
	$sx .= $line['pa_rg'];
	$sx .= '<TD>';
	$sx .= $line['pa_email'];
	$sx .= $line['pa_email_alt'];
	$sx .= '<TD>';
	$sx .= $line['pa_telefone'].' '.$pp['pa_celular'];
	$sx .= ' '.$line['pa_tel1'].' '.$pp['pa_cel2'];
	$sx .= '<TD>';
	$sx .= trim($line['pa_endereco']).', '.trim($line['pa_bairro']).'. '.trim($line['pa_cidade']).'-'.trim($line['pa_estado']);
		
		$sx .= '<TD>';
	$sx .= $line['pb_titulo_projeto'];
	$sx .= '<TD>';
	$sx .= $tipo_d;
	$sx .= '<TD>';
	$sx .= $doc_protocolo;
	$sx .= '<TD>';
	$sx .= $curso;
	$sx .= '<TD>';
	if ($line['pb_ativacao'] != '19000101')
		{
		$sx .= 'Data ativação '.stodbr($line['pb_ativacao']);
		} else {
		$sx .= '&nbsp;';
		}
	$sx .= '</TR>';
	}

echo '<table border="1">';
echo '<TR>';
echo '<TH>Orientador</TH>';
echo '<TH>Cod.Funcional</TH>';
echo '<TH>CPF.Orientador</TH>';
echo '<TH>Edital</TH>';
echo '<TH>Ano</TH>';
echo '<TH>Aluno</TH>';
echo '<TH>Cracha</TH>';
echo '<TH>Filiação</TH>';
echo '<TH>CPF</TH>';

echo '<TH>CC.Banco</TH>';
echo '<TH>CC.Age.</TH>';
echo '<TH>CC.Conta</TH>';
echo '<TH>CC.Tipo</TH>';

echo '<TH>RG</TH>';
echo '<TH>e-mail</TH>';
echo '<TH>telefone</TH>';
echo '<TH>endereço</TH>';
echo '<TH>Título do projeto do aluno</TH>';
echo '<TH>IC</TH>';
echo '<TH>Protocolo</TH>';
echo '<TH>Curso</TH>';
echo '<TH>Ativação</TH>';
echo '</TR>';
echo $sx;
echo '</table>';
require("foot.php");	
?>