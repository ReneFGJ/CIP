<?php
require("cab.php");
require($include.'sisdoc_data.php');
require("../_class/_class_body.php");

$check = $dd[90];
if (checkpost($dd[0])==$check)
	{
		$clx->le_submit($dd[0]);
		echo $clx->mostra();
		
		echo $clx->history();
		
		echo $clx->acao();
	}
echo '<BR><BR><BR>';
require("foot.php");
?>
