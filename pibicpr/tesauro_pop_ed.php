<?php
$include = '../';
require('../db.php');
require('../_class/_class_tesauro_editorial.php');
	
require('../_class/_class_message.php');	
$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$cl = new tesauro;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	
	$http_edit = 'tesauro_pop_ed.php';
	$http_redirect = '';
	$tit = 'Tesauros';

	/** Comandos de Edi��o */
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			echo 'Salvo';
			$cl->gera_arquivo_bibliioteca();
			$cl->updatex();
			redirecina('../close.php');
		}
require("../foot.php");
?>

