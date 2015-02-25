<?
require("db.php");
if (strlen($dd[1]) > 0)
	{
		if (strlen($dd[1]) == 7)
			{
			$sql = "update pibic_parecer_2011 ";
			$sql .= " set pp_protocolo = '".$dd[1]."' ";
			$sql .= " where id_pp = 0".$dd[0];
			$rlt = db_query($sql);
			require("close.php");
			} else {
			echo 'OPS';
			}
	} else {
		$sql = " select * from pibic_bolsa_contempladas ";
		$sql .= " inner join pibic_parecer_2011 on pp_protocolo = pb_protocolo ";
		$sql .= " inner join  pareceristas on pp_avaliador = us_codigo ";
		$sql .= " where id_pp = ".$dd[0];
		$sql .= " order by us_nome ";
		$rlt = db_query($sql);

		if ($line = db_read($rlt))
			{
			echo $line['us_nome'];
			}
		?>
		<form>
		<input type="hidden" name="dd0" value="<?=$dd[0];?>">
		<input type="hidden" name="dd1" value="X<?=substr($line['pp_protocolo'],1,7);?>">
		<input type="hidden" name="dd10" value="<?=$line['id_pb'];?>">
		<center><input type="submit" name="dd2" value="confirmar cancelamento"></center>
		</form>
		<?
	}
?>