<?
$include = '../';
require("../db.php");

$chk = $dd[90];
$ch1 = checkpost($dd[0]);

if (strlen($dd[1])==0)
	{ $dd[1] = 'pibic_parecer_'.date("Y"); }

if ($chk != $ch1)
	{
	//echo 'Erro de chave';
	//exit;
	}
	
if ((strlen($dd[20]) == 0) or (strlen($dd[3])==0))
	{
		$sql = "select * from ".$dd[1]." where id_pp = ".$dd[0];
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
				echo '<center>'.$line['pp_protocolo'];
				echo '<BR><BR>';
			}
		?>
		<center>
		<form method="post" action="parecer_alterar_status.php">
		<input type="hidden" name="dd0" value="<?=$dd[0];?>">
		<input type="hidden" name="dd1" value="<?=$dd[1];?>">
		<input type="hidden" name="dd2" value="<?=$dd[2];?>">
		Motivo da declina��o<BR>
		<select name="dd3">
			<option value="@">Reabrir para avalia��o</option>
			<option value="@">Finalizar avalia��o</option>
		</select>
		<BR>
		<input type="hidden" name="dd20" value="1">
		<input type="submit" name="acao" value="declinar submiss�o">
		</form>
		<?
	} else {
		$sql = "select * from ".$dd[1]." where id_pp = ".$dd[0];
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
				$protocolo = $line['pp_protocolo'];
				$sql = "update ".$dd[1]." set pp_status='".$dd[3]."'
						where id_pp = ".$dd[0]."
						or pp_protocolo_mae = '$protocolo'
						";
				$rlt = db_query($sql);
				require("../close.php");
			} else {
				echo 'Problema na localiza��o do protocolo';
			}
	}
?>