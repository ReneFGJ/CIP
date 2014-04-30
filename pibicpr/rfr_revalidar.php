<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$tabela = "pibic_parecer_".date("Y");
$sql = "select * from ".$tabela." 
	 	where pp_tipo = 'RFNR' and pp_status = 'B'
	 	order by pp_protocolo
		"
;
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$proto = $line['pp_protocolo'];
		$nota = $line['pp_p01'];
		$sql = "update ".$tabela." set pp_p10 = pp_p01, pp_p01 = '".$nota."'
		   		where pp_protocolo = '".$proto."' and pp_tipo = 'RFIN' ";
		$rrr = db_query($sql);
		
	}
echo '<h3>FIM</h3>';
require("../foot.php");	
?>