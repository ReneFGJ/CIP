<?php
require('cab.php');
require('../_class/_class_tesauro_editorial.php');
//require('../messages/msg_pibic_bolsa_tipo_ed.php');
$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	$cl = new tesauro;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	echo '<HR>'.$tabela.'<HR>';
	
	$http_edit = 'tesauro_editorial_ed.php';
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
			redirecina('tesauro_editorial.php');
		}
require("../foot.php");		
?>
