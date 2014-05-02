<?php
require("cab_pibic.php");

require("submit_type.php");

echo '<h2>Submissão de novo projeto do professor</h2>';

require("submit_pre.php");

$_SESSION['protocolo'] = '';
$_SESSION['proto'] = '';

/* RN: Habilita novo formulário de novo projeto */
$proto = $_SESSION['protocolo'];
require("../_class/_class_pibic_projetos.php");
$prj = new projetos;

if (strlen($proto)==0)
	{
		echo $prj->project_new_form();
	} else {
		redirecina('submit_pos_1.php');
	}

require("../foot.php");
?>