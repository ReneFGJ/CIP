<?
/** Publicação do resumo */

if (strlen($resumo) > 0)
	{
	
	require("sisdoc_resumo.php");
	echo '<BR>Exportação</BR>';
	$_titulo = $ttp; // Titulo do trabalho do aluno
	$_keys = $keyword;
	$_autores = $colaborador;
	$_resumo = $resumo;
	$_resumo = $resumo;
	$pa_curso = troca($pa_curso,' (Diurno)','');
	
	$exp = resumo_normalizacao($_titulo,$_autores,$_resumo,$_keys,$_para,$pa_curso);

	if (count($exp) > 1)
		{
			$histo = "Envio do resumo para publicação";

//			$sql = "ALTER TABLE pibic_bolsa_contempladas ADD COLUMN pb_semic int8 ";
//			$rlt = db_query($sql);
			
			$sql = "update pibic_bolsa_contempladas set ";
			$sql .= "pb_status = 'F',  ";
			$sql .= "pb_semic = '".date("Ymd")."' ";
			$sql .= " where id_pb = ".$dd[0].';';			
			$rlt = db_query($sql);

			$sql .= "insert into pibic_bolsa_historico ";
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
			$sql .= "'".$protocolo."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "0".$user_id.",'".$histo."','".$dd[3]."','".$dd[4]."','".$dd[9]."'); ";
			$rlt = db_query($sql);

			$sql = "";
			redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
		}
	}
?>