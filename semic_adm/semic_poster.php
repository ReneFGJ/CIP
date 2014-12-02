<?php
require("cab_semic.php");

$sql = "select * from semic_blocos where  blk_titulo like 'P%' ";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		echo '<HR>';
		$link = '<A HREF="semic_poster_avaliador.php?dd0='.$line['blk_codigo'].'">';
		echo '<BR>'.$link.$line['blk_titulo'];
		echo ' '.stodbr($line['blk_data']);
		echo ' '.$line['blk_hora'];
		echo '</A>';
	}
require("../foot.php");	
?>