<?
require("db.php");

$chk = $dd[90];
$ch1 = checkpost($dd[0]);

if ($chk != $ch1)
	{
	//echo 'Erro de chave';
	//exit;
	}
	
if (strlen($dd[20]) == 0)
	{
		?>
		<center>
		<form method="post" action="parecer_declinar.php">
		<input type="hidden" name="dd0" value="<?=$dd[0];?>">
		<input type="hidden" name="dd1" value="<?=$dd[1];?>">
		<input type="hidden" name="dd2" value="<?=$dd[2];?>">
		<input type="hidden" name="dd20" value="1">
		<input type="submit" name="acao" value="declinar submissão">
		</form>
		<?
	} else {
		$sql = "update ".$dd[1]." set pp_status='D' where id_pp = ".$dd[0];
		$rlt = db_query($sql);
		require("close.php");
	}
?>