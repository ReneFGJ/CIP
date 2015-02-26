<?
require("db.php");
$vr = 2233445566-$dd[0];

require($include."sisdoc_security.php");
require('cab_navegacao.php');
$pibic_ano = "2010";
security();
$user_id = read_cookie('nw_log');
if (round($user_id) > 0)
	{
	$user_log = read_cookie('nw_user');
	} else {
	$user_log = read_cookie('nw_log');
	$user_id = read_cookie('nw_user');
	}

if ($vr != $dd[1]) { echo 'Ops, erro de dados'; exit; }

if (strlen($acao) > 0)
	{
	if ($dd[2] == 'P')
		{ 
			$histo = "Protocolo ".$dd[7].", cancelamento de envio de relatório parcial";
			$sql = "update pibic_bolsa_contempladas set pb_relatorio_parcial = 0 where id_pb = ".$dd[0];
			$sql .= ";".chr(13).chr(10);
			$sql .= "insert into pibic_bolsa_historico ";
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
			$sql .= "'".$dd[7]."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "'".$user_id."','".$histo."','','',''); ";
		}

	if ($dd[2] == 'F')
		{ 
			$histo = "Protocolo ".$dd[7].", cancelamento de envio de relatório final";
			$sql = "update pibic_bolsa_contempladas set pb_relatorio_final = 0 where id_pb = ".$dd[0];
			$sql .= ";".chr(13).chr(10);
			$sql .= "insert into pibic_bolsa_historico ";
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
			$sql .= "'".$dd[7]."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "'".$user_id."','".$histo."','','',''); ";
		}

	if ($dd[2] == 'R')
		{ 
			$histo = "Protocolo ".$dd[7].", cancelamento de envio de Resumo Final";
			$sql = "update pibic_bolsa_contempladas set pb_resumo = 0 where id_pb = ".$dd[0];
			$sql .= ";".chr(13).chr(10);
			$sql .= "insert into pibic_bolsa_historico ";
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
			$sql .= "'".$dd[7]."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "'".$user_id."','".$histo."','','',''); ";
		}

		if (strlen($sql) > 0)
			{
			$rlt = db_query($sql);

			echo '<center><H1>Submissão cancelada com sucesso!</H1>';
			echo '<form action="close.php"><input type="submit" name="acao" value="fechar"></form></center>';
			exit;
			}
	}

$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
$sql .= "left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where id_pb = ".$dd[0];
$sql .= "order by pa_nome";
$rlt = db_query($sql);

$sx = '';
if ($line = db_read($rlt))
	{
	if ($dd[2] == 'P') { echo '<CENTER><H1>Cancelar Submissão do Relatório Parcial</H1></CENTER>'; }
	?>
	<form action="pibic_relatorio_envio_cancelar.php" method="post">
	<center>
	<input type="hidden" name="dd0" value="<?=$dd[0];?>">
	<input type="hidden" name="dd1" value="<?=$dd[1];?>">
	<input type="hidden" name="dd2" value="<?=$dd[2];?>">
	<input type="hidden" name="dd7" value="<?=$line['doc_protocolo'];?>">
	<table align="center">
	<TR><TD><input type="submit" name="acao" value="Confirma cancelamento de envio" style="width: 350px; height:50px;"></TD></TR>
	</table>
	</center>
	</form>
	<?
	}
?>