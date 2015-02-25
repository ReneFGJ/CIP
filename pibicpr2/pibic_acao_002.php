<?
$tabela = "pibic_bolsa_contempladas";

if ((strlen($dd[3]) == 10) and ($dd[4] == 'S'))
	{
	$sql = "select * from pibic_bolsa_contempladas where id_pb = ".$dd[0]." ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$protocolo = trim($line['pb_protocolo']);
		if (($line['pb_status'] == 'A') or ($line['pb_status'] == '@'))
			{
			$tipo = $line['pb_tipo'];
			echo '>>>>>>>>>>>>>>>>>>>>>>>'.$tipo;
			if (($tipo == 'F') or ($tipo == 'C') or ($tipo == 'P'))
				{
					echo 'Liberar bolsa '.$tipo;
					echo '<BR>';
//					echo 'Não é possível cancelar esse tipo de contrato, somente substituição';
					
					$histo = "Protocolo ".$protocolo.", cancelamento de bolsa, renuncia em ".$dd[3];
					$sql = "update ".$tabela." set pb_status = 'C' ";
					$sql .= " where id_pb = ".$dd[0].';';

					$sql .= "insert into pibic_bolsa_historico ";
					$sql .= "(bh_protocolo,bh_data,bh_hora,";
					$sql .= "bh_log,bh_historico,bh_acao) values (";
					$sql .= "'".$protocolo."','".date("Ymd")."','".date("H:i")."',";
					$sql .= "0".$user_id.",'".$histo."',91); ";
					$rlt = db_query($sql);
					$sql = "";
					redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
					exit;
				} else {
					echo 'Bolsa ICV';
				}
				$histo = "Cancelamento de contrato em ".$dd[3];
				$sql = "update ".$tabela." set ";
				$sql .= "pb_status = 'C' ";
				$sql .= " where id_pb = ".$dd[0].';';

				$sql .= "insert into pibic_bolsa_historico ";
				$sql .= "(bh_protocolo,bh_data,bh_hora,";
				$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
				$sql .= "'".$dd[5]."','".date("Ymd")."','".date("H:i")."',";
				$sql .= "0".$user_id.",'".$histo."','".$dd[3]."','".$dd[4]."','".$dd[7]."'); ";
				$rlt = db_query($sql);
				$sql = "";
				redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
				echo $sql;
			}
			
		} else {
			$msg = "Projeto não cadastrado";
		}
	}

$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$A8','','Cancelamento de Contrato',False,False,''));
array_push($cp,array('$HV','',$dd[2],False,True,''));
array_push($cp,array('$D8','','Data da renuncia do contrato',False,False,''));
array_push($cp,array('$O N:NÃO&S:SIM','','Confirma operação ?',False,True,''));
array_push($cp,array('$S8','pb_protocolo','Protocolo de Submissão',False,False,''));
array_push($cp,array('$HV','','',True,True,''));
array_push($cp,array('$Q motivo_descricao:motivo_codigo:select * from pibic_motivo where motivo_tipo = 1 order by motivo_descricao','','Motivo',True,True,''));

	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
exit;
?>