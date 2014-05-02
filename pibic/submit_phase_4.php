<?php
require("cab.php");
require("cab_main.php");
require($include."sisdoc_tips.php");

if (strlen($ss->user_cracha)==0)
	{ redirecina('index.php'); }

require($include."sisdoc_breadcrumb.php");
$pos = new position;

$pos->items = array(array('título do projeto<BR>do professor','00',''),
			  array('dados do projeto','00','submit_phase_1.php'),
			  array('plano do aluno','00','submit_phase_3.php'),
			  array('pibic jr','01','submit_phase_4_sel.php'),
			  array('finalização','00','pibic_projeto.php'));

require($include."sisdoc_form2.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");

require($include."cp2_gravar.php");

require("../_class/_class_ged.php");
$ged = new ged;

require("../_class/_class_pibic_projetos.php");
$prj = new pibic_projetos;

/* Mostra projeto */
echo $pos->display();

$proto = $_SESSION['protocolo'];
$prj->protocolo = $proto;

if (strlen($proto)==0)
	{ redirecina('main.php'); }
	
echo $prj->mostra_projeto();

if ($dd[0]=='NEW')
	{
		$prj->submit_plano_jr_new();
	}


echo $prj->submit_plano_jr();

require("foot.php");
?>