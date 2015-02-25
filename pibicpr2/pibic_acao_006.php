<?
$tabela = "pibic_bolsa_contempladas";
if ((strlen($dd[3]) == 8) and (strlen($dd[4]) == 8) and ($dd[5] == 'S') and ($dd[4] != $dd[3]))
	{
	$sql = "select * from pibic_professor where pp_cracha = '".$dd[4]."' ";
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
			$histo = "Protocolo ".$dd[7].", troca de orientador de ".$dd[3]." para ".trim($line['pp_nome']). '('.$dd[4].')';
			$sql = "update ".$tabela." set pb_professor = '".$dd[4]."' ";
			$sql .= " where id_pb = ".$dd[0].';';
			
				$sql .= "insert into pibic_bolsa_historico ";
				$sql .= "(bh_protocolo,bh_data,bh_hora,";
				$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
				$sql .= "'".$dd[5]."','".date("Ymd")."','".date("H:i")."',";
				$sql .= "0".$user_id.",'".$histo."','".$dd[3]."','".$dd[4]."','".$dd[9]."'); ";
				$rlt = db_query($sql);
			
			$rlt = db_query($sql);
			$sql = "";
			redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
			echo $sql;
			
		} else {
			$msg = "Aluno nуo cadastrado";
		}
	}

$dd[3] = trim($prof_cracha);
$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$A8','','Alteraчуo de orientador do projeto ',False,False,''));
array_push($cp,array('$HV','',$dd[2],False,True,''));
array_push($cp,array('$S8','pb_professor','Professor (cracha)',False,False,''));
array_push($cp,array('$S8','','Alterar para (cracha)',False,True,''));
array_push($cp,array('$O N:NУO&S:SIM','','Confirma operaчуo ?',False,True,''));
array_push($cp,array('$B8','','Alterar agora',False,True,''));
array_push($cp,array('$H8','pb_protocolo','',False,True,''));
array_push($cp,array('$H4','','',True,True,''));
array_push($cp,array('$Q motivo_descricao:motivo_codigo:select * from pibic_motivo where motivo_tipo = 1 order by motivo_descricao','','Motivo',True,True,''));

$dd[2] = '001';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
exit;
?>