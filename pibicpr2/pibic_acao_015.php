<?
$tabela = "pibic_bolsa_contempladas";

if ((strlen($dd[3]) == 10) and ($dd[4] == 'S'))
	{
	$sql = "select * from pibic_bolsa_contempladas where id_pb = ".$dd[0]." ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		if ($line['pb_status'] == '@')
			{
				$tipo = $line['pb_tipo'];
				echo '>>>>>>>>>>>>>>>>>>>>>>>'.$tipo;
				echo 'Liberar bolsa '.$tipo;
				echo '<BR>';
	//					echo 'Não é possível cancelar esse tipo de contrato, somente substituição';
						
				$histo = "Protocolo ".$dd[5].", ativado em ".$dd[3];
				$sql = "update ".$tabela." set pb_status = 'A' ";
				$sql .= " where id_pb = ".$dd[0].';';
	
				$sql .= "insert into pibic_bolsa_historico ";
				$sql .= "(bh_protocolo,bh_data,bh_hora,";
				$sql .= "bh_log,bh_historico) values (";
				$sql .= "'".$dd[5]."','".date("Ymd")."','".date("H:i")."',";
				$sql .= "0".$user_id.",'".$histo."'); ";
				$rlt = db_query($sql);
				$sql = "";
				redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
				exit;
			}
		}
	}

$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$A8','','Ativação de Aluno',False,False,''));
array_push($cp,array('$HV','',$dd[2],False,True,''));
array_push($cp,array('$D8','','Data de ativação',False,False,''));
array_push($cp,array('$O N:NÃO&S:SIM','','Confirma operação ?',False,True,''));
array_push($cp,array('$H8','pb_protocolo','Protocolo de Submissão',False,False,''));
array_push($cp,array('$HV','','',True,True,''));

	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
exit;
?>