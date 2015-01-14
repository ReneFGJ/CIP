<?php
require("cab_semic.php");
require("../_class/_class_semic_ouvinte.php");

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');

	$cl = new ouvinte;	
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	
	$http_edit = page();
	$http_redirect = '';
	$tit = msg("titulo");

	/** Comandos de Edição */
	echo '<div id="content">';
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			echo 'Salvo';
			redirecina('semic_ouvintes.php');
		}
	echo '</div>';
require("../foot.php");
?>
