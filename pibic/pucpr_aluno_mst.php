<?
$qsql = "select * from ".$tdoc." ";
$qsql .= " inner join pibic_aluno on pa_cracha = doc_aluno ";
$qsql .= " where doc_protocolo = '".$protocolo."'";
$qrlt = db_query($qsql);
if ($qline = db_read($qrlt))
	{
	$sp .= '<TR class=lt1><TD align="right">Nome do aluno</TD><TD><B>'.$qline['pa_nome'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">Tipo</TD><TD><B>'.$qline['pa_escolaridade'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">CPF</TD><TD><B>'.$qline['pa_cpf'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">Centro</TD><TD><B>'.$qline['pa_centro'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">Curso</TD><TD><B>'.$qline['pa_curso'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">telefone</TD><TD><B>'.$qline['pa_tel1'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">&nbsp;</TD><TD><B>'.$qline['pa_tel2'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">e-mail</TD><TD><B>'.$qline['pa_email'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">&nbsp;</TD><TD><B>'.$qline['pa_email_1'].'</TD></TR>';
	}
?>
