<?php
require("cab_pibic.php");
echo '==================';
$proto = $dd[0];
if (strlen($proto) > 0)
	{
		$_SESSION["proto_aluno"] = $proto;
		redirecina('submit_phase_3.php');
	} else {
		redirecina('submit_pibic_projeto.php');
	}
?>