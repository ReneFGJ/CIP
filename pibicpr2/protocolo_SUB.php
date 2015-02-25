<?
require("cab.php");

$sql = "select *,pr_codigo,pr_tipo, pr_status,";
$sql .= " a1.pa_nome as nome1, ";
$sql .= " a2.pa_nome as nome2, ";
$sql .= " pr_data, pr_aluno_1, pr_aluno_2, ";
$sql .= " pr_hora ";

$sql .= "  from pibic_protocolo ";
$sql .= " left join pibic_aluno as a1 on a1.pa_cracha = pr_aluno_1 ";
$sql .= " left join pibic_aluno as a2 on a2.pa_cracha = pr_aluno_2 ";
$sql .= " where pr_status = 'A' ";
$sql .= " and pr_codigo = '".$dd[0]."' ";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$para = $line['pr_aluno_1'];
	$de = $line['pr_aluno_2'];
	$motivo = $line['pr_motivo'];
	
/////////////////////////////////////////// VERIFICA SE O INDICADO NÂO TEM PROJETO INDICADO
	$sql = "select * from pibic_bolsa_contempladas ";
	$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
	$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
	$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
	$sql .= "left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
	//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
	$sql .= " where pb_aluno = '".$para."'";
	$sql .= " and pb_status = 'A' ";
	$sql .= "order by pa_nome";	
	$rlt = db_query($sql);

	if ($line = db_read($rlt))
		{
		echo '<table>';
		require("pibic_busca_resultado.php");
		echo $sr;
		echo '</table>';
		echo '<H2><font color="red">Estudante já está vinculada a um projeto</font></H2>';
		exit;
		}
		
/////////////////////////////////////// VERIFICA SE O PROJETO DO RETIRADO ESTA ATIVO
	$sql = "select * from pibic_bolsa_contempladas ";
	$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
	$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
	$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
	$sql .= "left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
	//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
	$sql .= " where pb_aluno = '".$de."'";
	$sql .= " and pb_status = 'A' ";
	$sql .= "order by pa_nome";	
	$rlt = db_query($sql);

	if (!$line = db_read($rlt))
		{
		echo '<H2><font color="red">Estudante não tem projeto ativo</font></H2>';
		exit;
		}
	$protocolo = $line['pb_protocolo'];
	$id = $line['id_pb'];
	
	$link = "protocolo_SUB_acao.php?dd0=".$id."&dd3=".$de."&dd4=".$para.'&dd6='.$motivo.'&dd8='.$protocolo.'&acao=gravar';
	redirecina($link);
	}
	
require("foot.php");	?>