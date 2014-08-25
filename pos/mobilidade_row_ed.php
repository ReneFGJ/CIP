<?php
require('cab_pos.php');

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	require("../_class/_class_mobilidade.php");
	$cl = new mobilidade;
	$cp = $cl->cp_tipo();
	
	$http_edit = 'mobilidade_row_ed.php';
	$http_redirect = '';
	
	$tabela = $cl->tabela_tipo;
	/** Comandos de Edição */
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			redirecina('mobilidade_row.php');
		}
require("../foot.php");	
?>

