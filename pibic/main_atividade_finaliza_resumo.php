<?
echo '<BR>FIM';

$sql = "update pibic_bolsa_contempladas set ";
$sql .= " pb_resumo = ".date("Ymd");
$sql .= ", pibic_resumo_text = '".$dd[10]."'";
$sql .= ", pibic_resumo_colaborador = '".$dd[11]."' ";
$sql .= ", pibic_resumo_keywork = '".$keyws."' ";
$sql .= ", pb_resumo_nota = '9' ";
$sql .= " where id_pb = ".$dd[1]." ";
$rlt = db_query($sql);

?>
<center>
<form method="post" action="main.php"><input type="submit" name="acao" value="voltar para tela inicial"></form></center>