<?php
require("cab_pibic.php");

if (strlen($ss->user_cracha)==0)
	{ redirecina('index.php'); }
	
require($include."sisdoc_tips.php");

require("../_class/_class_position.php");
$pos = new posicao;
$pos->position = 0;
/* Mostra projeto */
echo $pos->show(2,5,array());

require($include."sisdoc_form2.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."cp2_gravar.php");
require($include."sisdoc_windows.php");
echo '<fieldset>';
require("../_class/_class_ged.php");
$ged = new ged;

require("../_class/_class_pibic_projetos.php");
$prj = new pibic_projetos;

if (strlen($dd[89]) > 0)
	{
		$proto = $dd[89];
		$proto2 = $dd[90];
		$_SESSION['protocolo'] = $proto;
		$_SESSION["proto_aluno"] = $proto2;	
	} else {
		$proto = $_SESSION['protocolo'];		
	}


$prj->protocolo = $proto;

if (strlen($proto)==0)
	{ redirecina('main.php'); }
	
echo $prj->mostra_projeto();

if ($dd[0]=='NEW')
	{
		if ($prj->internaciona == 1)
			{
				$prj->submit_plano_ici_new();
			} else {
				$prj->submit_plano_new();		
			}		
		exit;
	}


echo $prj->submit_plano();
echo '</fieldset>';
require("foot.php");
?>