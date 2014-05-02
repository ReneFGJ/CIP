<?php
require("cab_pibic.php");

/* RN: Se for edição, repassa número do protocolot */
if (strlen($dd[89]) > 0)
	{
		$_SESSION['protocolo'] = $dd[89];
		$proto = $dd[89];
	} else {
		$proto = $_SESSION['protocolo'];		
	}

if (strlen($ss->user_cracha)==0)
	{ redirecina('index.php'); }
	
require($include."sisdoc_tips.php");
require("../_class/_class_position.php");
$pos = new posicao;
$pos->items = array(array('título do projeto<BR>do professor','00',''),
			  array('dados do projeto','00','submit_phase_1.php'),
			  array('plano do aluno','01','submit_phase_3_sel.php'),
			  array('pibic jr','00','submit_phase_4_sel.php'),
			  array('finalização','00','submit_pibic_projeto.php'));
$pos->position = 0;

/* Mostra projeto */
echo $pos->show(4,5,array());

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

$proto = $_SESSION['protocolo'];
$prj->protocolo = $proto;

if (strlen($proto)==0)
	{ redirecina('main.php'); }
	
echo $prj->mostra_projeto();

if ($dd[0]=='NEW')
	{
		$prj->submit_plano_new();
		exit;
	}


echo $prj->submit_plano();
echo '</fieldset>';
require("foot.php");
?>