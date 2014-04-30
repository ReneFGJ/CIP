<?php
require("cab.php");

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

$ar = array('Arquitetura e Urbanismo - Escola Politécnica');
$at = array('Arquitetura e Urbanismo - Escola de Arquitetura e Design');
$al = array('autor');

// Escola de Arquitetura e Design 
if (strlen($dd[1]) > 10)
	{
		$fld = 'article_author';
		
		$dd1 = $dd[1];
		$sql = "select * from articles 
			where journal_id = $jid 
			and $fld like '%$dd1%'
			";
		$rlt = db_query($sql);
		$id = 0;
		while ($line = db_read($rlt))
		{
			$txt = trim($line[$fld]);
			$txt = troca($txt,$dd[1],$dd[2]);
			
			$sql = "update articles set $fld = '$txt' where id_article = ".$line['id_article'];
			$xrlt = db_query($sql);
			$id++;
		}
		echo $id.' trocas realizadas';
	}

?>
<form method="post" action="<?=page();?>">
	<BR>DE:<BR>
	<input type="text" size="60" name="dd1" value="<?=$dd[1];?>" />
	<BR>PARA:<BR>
	<input type="text" size="60" name="dd2" value="<?=$dd[2];?>" />
	<BR>ONDE:</BR>
	<select name="dd3">
			<option value="001">Autores</option>		
	</select>
	<BR>
		<input type="submit" value="enviar >>>">
</form>
<?



require("../foot.php");
?>
