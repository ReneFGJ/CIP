<?
$include = '../';
session_start();
require("../db.php");
require($include.'sisdoc_debug.php');
require("_class/_class_parecer.php");
$pr = new parecer; 

$chk = $dd[90];
$ch1 = checkpost($dd[0]);

if ((strlen($dd[20]) == 0) or (strlen($dd[50])==0))
	{
		$sql = "select * from submit_parecer_2013 where id_pp = ".$dd[0];
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
				echo '<center>'.$line['pp_protocolo'];
				echo '<BR><BR>';
			}
		?>
		<center>
		<form method="post" action="parecer_declinar.php">
		<input type="hidden" name="dd0" value="<?=$dd[0];?>">
		<input type="hidden" name="dd1" value="<?=$dd[1];?>">
		<input type="hidden" name="dd2" value="<?=$dd[2];?>">
		Motivo da declinação<BR>
		<textarea name="dd50" cols="40" rows="3"><?=$dd[50];?></textarea>
		<BR>
		<input type="hidden" name="dd20" value="1">
		<input type="hidden" name="dd5" value="<?php echo $dd[5];?>">
		<input type="submit" name="acao" value="declinar submissão">
		</form>
		<?
	} else {
		if ($dd[5]=='reol_parecer_enviado')
		{
		$sql = "update reol_parecer_enviado set pp_status='D'
				where id_pp = ".$dd[0];
		} else {
		$sql = "update submit_parecer_2013 set pp_status='D',
				pp_abe_14 = '".$dd[50]."'
				where id_pp = ".$dd[0];			
		}
		$rlt = db_query($sql);
		?>
		<script>
			close();
		</script>
		<?
	}
?>