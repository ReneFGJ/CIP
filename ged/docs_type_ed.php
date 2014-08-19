<?php
require('cab.php');
require('../_class/_class_calendario.php');
require($include.'sisdoc_debug.php');
$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');

require("_ged_config_docs.php");

	$cl = new ged;
	$cp = $cl->cp_type();
	$tabela = $ged->tabela.'_tipo';
	
	$http_edit = 'docs_type_ed.php';
	$http_redirect = '';
	$tit = msg("titulo");

	/** Comandos de Edição */
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			echo 'Salvo';
			$ged->updatex();
			redirecina('docs_type.php');
		}
		
?>

