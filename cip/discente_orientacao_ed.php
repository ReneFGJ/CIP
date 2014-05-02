<?php
require('cab.php');
require($include.'sisdoc_data.php');
global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');


require("../_class/_class_docentes.php");
	$cl = new docentes;
	$cp = $cl->cp_docente_orientacoes();
	$tabela = 'docente_orientacao';
	
	$http_edit = page();
	$http_redirect = '';
	$tit = msg("titulo");

	/** Comandos de Ediçãoo */
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			echo 'Salvo';
			//$cl->updatex();
			redirecina('discente_orientacao.php');
		}
		
?>


