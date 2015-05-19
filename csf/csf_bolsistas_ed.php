<?php
require('cab.php');
require('../_class/_class_pibic_bolsa_contempladas.php');

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
$debug = true;
ini_set('display_errors', 255);
ini_set('error_reporting', 255);
	$cl = new pibic_bolsa_contempladas;
	$cp = $cl->cp_csf();

	$tabela = $cl->tabela;
	
	$http_edit = page();
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
			$cl->updatex();
			redirecina('csf_bolsistas.php');
		}
		
?>

