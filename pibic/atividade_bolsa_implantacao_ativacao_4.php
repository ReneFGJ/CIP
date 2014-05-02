<?
	$sql = "select * from pibic_bolsa ";
	$sql .= " where id_pb = ".$dd[0];
	$rlt = db_query($sql);
	$line = db_read($rlt);

	$aluno = $line['pb_aluno'];
	$aluno_sub = trim($line['pa_substituicao']);
	
	if (strlen($aluno_sub) == 0)
		{
			$sql = "update pibic_bolsa set pb_motivo = '".$dd[20]."', pb_aluno = '".trim($dd[10])."', pa_substituicao = '".trim($aluno)."' ";
			$sql .= " where id_pb = ".$dd[0];
		} else {
			$sql = "update pibic_bolsa set pb_motivo = '".$dd[20]."', pb_aluno = '".trim($dd[10])."' ";
			$sql .= " where id_pb = ".$dd[0];
		}
	$rlt = db_query($sql);
	
	$link = 'atividade_bolsa_implantacao_ativacao.php?dd0='.$dd[0]."&dd1=".$dd[1]."&dd2=".$dd[2].'&dd5=2';
	redirecina($link);
?>