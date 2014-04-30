<?php
require("cab.php");
require("../_class/_class_docentes.php");

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_form2.php');

	$cl = new docentes;	
	$cp = $cl->cp_blacklist();
	$tabela = $cl->tabela;
	$http_edit = page();
	$http_redirect = '';
	$tit = msg("docente");

	/** Comandos de Edição */
	echo '<div id="content">';
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			redirecina('docente.php?dd0='.$dd[0]);
		}
	echo '</div>';
require("../foot.php");
?>
