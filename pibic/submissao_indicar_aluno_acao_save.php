<?
$icv = $dd[6];
if ($icv == 'S') { $icv = 1; } else { $icv = 0; }
$sql = "update pibic_submit_documento set ";
$sql .= " doc_aluno = '".$dd[5]."', ";
$sql .= " doc_icv = '".$icv."' ";
$sql .= " where doc_aluno = '00000000' ";
$sql .= " and (doc_status <> 'X' and doc_status <> '@') ";
$sql .= " and (doc_protocolo = '".$dd[0]."')";
$rlt = db_query($sql);

/* Grava valores */
$sql = "update pibic_submit_documento_valor set ";
$sql .= " spc_content = '".$dd[5]."' ";
$sql .= " where spc_projeto = '".$protocolo."' ";
$sql .= " and spc_content = '00000000' ";
$rlt = db_query($sql);

/* Dados para Parte II */
		$dd[4] = $dd[5];
		$dd[3] = '00000000';
		$dd[5] = 'S';
		$dd[6] = '001';
		$dd[8] = $dd[0];
		$dd[10] = $dd[1];
		
/* Chama parte II da gravação */
require("submissao_indicar_aluno_acao_save_001.php");

/* Mensagem Final */
echo '<H2><font color="green">Substituição realizada com Sucesso!</font></H2>';
?>