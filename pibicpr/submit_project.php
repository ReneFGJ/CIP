<?php
require("cab_pibic.php");
echo '<h2>Submissão de projeto</h2>';

/* Projetos submetidos */
	/*** SUBMISSAO **/
	require("../_class/_class_pibic_projetos.php");
	$prj = new projetos;	
	$prj->resumo_projetos();
	
/* Submeter projeto de pesquisa */

	$sx = '<form method="post" action="submit_phase_0.php">';
	$sx .= '<input type="hidden" name="dd0" value="NEW">';
//	$ss .= '<form method="post" action="submit_phase_1_pibic.php">';
	$sx .= '<input type="submit" name="acao" value="Submeter novo projeto >>>">';
	$sx .= '</form>';
	$sx .= '</TD></TR>';
	echo $sx;

require("../foot.php");
?>
