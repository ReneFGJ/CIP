<?php
require('cab.php');
require('../_class/_class_docentes.php');
$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	$cl = new docentes;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	
	$http_edit = 'docentes_ed.php';
	$http_redirect = '';
	$tit = msg("titulo");

	/** Comandos de Edi��o */
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			redirecina('docentes.php');
		}
		
?>

