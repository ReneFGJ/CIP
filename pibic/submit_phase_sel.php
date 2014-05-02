<?php
require("cab.php");
require("cab_main.php");
require($include."sisdoc_tips.php");
require($include."sisdoc_breadcrumb.php");

require("../_class/_class_pibic_projetos.php");
$prj = new pibic_projetos;

if ($dd[90]==checkpost($dd[0]))
	{
		$prj->le($dd[0]);
		$_SESSION['protocolo'] = $prj->protocolo;
		redirecina('submit_phase_1.php');
	}

require("foot.php");
?>
<td valign="middle"
