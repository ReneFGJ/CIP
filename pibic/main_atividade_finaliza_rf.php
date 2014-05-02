<?
echo '<BR>FIM';
$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where id_pb = ".$dd[1]."";
$sql .= "order by pa_nome";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
//	print_r($line);
	}
	

$sql = "update pibic_bolsa_contempladas set ";
$sql .= " pb_relatorio_final = '".date("Ymd")."', ";
$sql .= " pb_relatorio_final_nota = 9 ";
$sql .= " where id_pb = '".$dd[1]."' ";


$rlt = db_query($sql);

?>
<center>
<form method="post" action="main.php"><input type="submit" name="acao" value="voltar para tela inicial"></form></center>