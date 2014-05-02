<?php
require("cab_pibic.php");

require($include."sisdoc_tips.php");
require("../_class/_class_position.php");
$pos = new posicao;
$pos->items = array(array('título do projeto<BR>do professor','01',''),
			  array('dados do projeto','00',''),
			  array('plano do aluno','00',''),
			  array('pibic jr','00',''),
			  array('finalização','00',''));
$pos->position = 0;

require("../_class/_class_pibic_projetos.php");
$prj = new pibic_projetos;
/* Mostra projeto */
echo $pos->show(2,5,array());

require("_ged_config_submit_pibic.php");

echo '<fieldset>';
echo '<H3>Anexar projeto do professor</h3>';
echo $ged->file_list();
echo $ged->upload_botton_with_type('','','PROJ');
echo '</fieldset>';
if ($saved > 0)
	{
		redirecina("submit_phase_1.php");
	}
	
echo '<form action="submit_phase_1.php">';
echo '<input type="submit" value="salvar e avançar >>>" class="botao-geral">';
echo '</form>';
require("foot.php");
?>
<td valign="middle"
