<?php
require("cab_pibic.php");

if (strlen($ss->user_cracha)==0)
	{ redirecina('index.php'); }

require($include."sisdoc_tips.php");
require("../_class/_class_position.php");
$pos = new posicao;

$pos->items = array(array('título do projeto<BR>do professor','00',''),
			  array('dados do projeto','01','submit_phase_1.php'),
			  array('plano do aluno','00','submit_phase_3_sel.php'),
			  array('pibic jr','00','submit_phase_4_sel.php'),
			  array('finalização','00','submit_pibic_projeto.php'));
$pos->position = 0;
	
require($include."sisdoc_form2.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."cp2_gravar.php");
require("../_class/_class_pibic_projetos.php");
$prj = new pibic_projetos;
$prj->protocolo = $_SESSION['protocolo'];

/* Mostra projeto */
/* Mostra projeto */
echo $pos->show(2,5,array());

echo $prj->submit_projeto();

require("foot.php");
?>
<td valign="middle"
