<?
require("cab.php");

$bb1 = "desmacar";
?>
Informe o código da área do conhecimento para desmarcar. EX: 3.11
<form method="post" action="ajax_areadoconhecimento_sel.php">
	<input type="text" size="10" name="dd1" />
	<BR>Informe (0:desmarcar ou 1:marcar)<input type="text" size="1" name="dd2" />
	<input type="submit" name="acao" value="<?=$bb1;?>">
</form>

<?
if (($acao == $bb1) and (strlen($dd[1]) > 3) and (strlen($dd[2]) == 1))
	{
	$dd[2] = round($dd[2]);
	$sql= "select * from ajax_areadoconhecimento where a_cnpq like '".$dd[1]."%'";
	$sql .= " order by a_cnpq ";
	$rlt = db_query($sql);	
	echo '<table border=1 >';
	while ($line = db_read($rlt))
		{
		echo '<TR>';
		echo '<TD>';
		echo $line['a_cnpq'];
		echo '<TD>';
		echo $line['a_descricao'];
		echo '<TD>';
		if ($dd[2]==1)
			{ echo '<font color="green">Marcado'; } 
			else {
				echo '<font color="red">Desmarcado';
			}	
		$sql = "update ajax_areadoconhecimento set a_semic = ".$dd[2]." where id_aa = ".$line['id_aa'];
		$rrr = db_query($sql);
		}
	echo '</table>';
	}
?>
