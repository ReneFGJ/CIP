<?
require("db.php");
require($include."sisdoc_debug.php");
if (strlen($dd[1]) > 0)
	{
		if (strlen($dd[1]) == 7)
			{
			$sql = "update pibic_bolsa_contempladas set pb_relatorio_final_nota = 0, pb_resumo_nota = 0 ";
			$sql .= " where id_pb = ".$dd[10];
			$sql .= " and pb_protocolo = '".$dd[2]."' ";
//			echo $sql;
//			exit;
			$rlt = db_query($sql);
			
			$sql = "update pibic_parecer_2010 set pp_status = 'R' where id_pp = ".$dd[0];
			$rlt = db_query($sql);

			require("close.php");
			} else {
			echo 'OPS';
			}
		exit;
	} else {
		$sql = " select * from pibic_bolsa_contempladas ";
		$sql .= " inner join pibic_parecer_2011 on pp_protocolo = pb_protocolo ";
		$sql .= " inner join  pareceristas on pp_avaliador = us_codigo ";
//		$sql .= " where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F') ";
		$sql .= " where pb_status <> 'C' ";
//		$sql .= " and pb_relatorio_final_nota <> 0 ";
		$sql .= " and id_pp = ".$dd[0];
		$sql .= " order by us_nome ";
		$rlt = db_query($sql);
		
		if ($line = db_read($rlt))
			{
			echo $line['us_nome'];
			}
		?>
		<CENTER>ANULAR PARECER</CENTER>
		<form>
		<input type="hidden" name="dd0" value="<?=$dd[0];?>">
		<input type="hidden" name="dd1" value="X<?=substr($line['pp_protocolo'],1,7);?>">
		<input type="hidden" name="dd2" value="<?=$line['pp_protocolo'];?>">
		<input type="hidden" name="dd10" value="<?=$line['id_pb'];?>">
		<center><input type="submit" name="dd3" value="confirmar anulação"></center>
		</form>
		<?
	}
?>