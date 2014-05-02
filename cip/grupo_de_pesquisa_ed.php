<?php
require('cab_cip.php');
require('../_class/_class_grupo_de_pesquisa.php');
require($include.'sisdoc_data.php');

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); } else { echo 'message not found '.$link_msg; }
	
$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$cl = new grupo_de_pesquisa;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	
	$http_edit = 'grupo_de_pesquisa_ed.php';
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
			$cl->updatex();
			redirecina('grupo_de_pesquisa.php');
		}
		
?>


