<?php
require('cab.php');
//$ln = new message;
global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

echo $hd->menu();
echo '<div id="conteudo">';

	/* Dados da Classe */
	require("_class/_class_submit_cp4.php");
	$cl = new campo_04;
	$cp = $cl->cp();
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
			redirecina('submit_campo_04.php');
		}
echo '</div>';		
require("foot.php");	
?>

