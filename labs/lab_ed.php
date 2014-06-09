<?php
require('cab.php');
global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');

require($include.$include.'_class_form.php');
$form = new form;

require($include.'sisdoc_data.php');

	require("../_class/_class_laboratorio.php");
	$cl = new laboratorio;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	
	$http_edit = page();
	$http_redirect = '';

	/** Comandos de Edi��o */
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	$tela = $form->editar($cp,$tabela);
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			$cl->updatex();
			echo 'Salvo';
			redirecina('labs.php');
		} else {
			echo $tela;
		}
		
?>

