<?php
require('cab.php');
require('../_class/_class_bonificacao.php');

$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'_class_form.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	$cl = new bonificacao;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	
	/* Mensagens */
	$link_msg = '../messages/msg_'.$tabela.'_ed.php';
	if (file_exists($link_msg)) { require($link_msg); }	
	
	$http_edit = 'bonificacoes_ed.php';
	$http_redirect = '';
	$tit = msg("titulo");

	/** Comandos de Edição */
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	$tela = $form->editar($cp,$tabela);
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			redirecina('bonificacoes.php');
		} else {
			echo $tela;
		}
require("../foot.php");	
?>

