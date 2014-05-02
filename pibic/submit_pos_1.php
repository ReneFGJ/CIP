<?php
require("cab_pibic.php");
require("submit_type.php");

echo '<h2>Submissão de novo projeto do professor</h2>';

require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require("_ged_config_submit_pibic.php");

require("submit_pre.php");

require("../_class/_class_pibic_projetos.php");
$prj = new projetos;

require("../_class/_class_position.php");
$pos = new posicao;
$pos->position = 0;
/* Mostra projeto */
echo $pos->show(1,5,array());

/* RN: Se for edição, repassa número do protocolot */
if (strlen($dd[89]) > 0)
	{
		$_SESSION['protocolo'] = $dd[89];
		$proto = $dd[89];
	} else {
		$proto = $_SESSION['protocolo'];		
	}
	
/* RN: Habilita novo formulário de novo projeto */


if (strlen($proto)==0)
	{
		redirecina('submit_project.php');
	} else {
		echo $prj->project_professor_dados();
	}

require("../foot.php");
?>