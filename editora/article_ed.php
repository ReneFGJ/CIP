<?php
$include = '../';
require("../db.php");
require("../_class/_class_message.php");

require("../_class/_class_article.php");
$ar = new article;

require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	$tabela = $ar->tabela;
	$cp = $ar->cp_simple();

//	$http_edit = 'admin_docs_type_ed.php';
//	$http_ver = 'admin_docs_type_ver.php';
//	$http_redirect = '';
//	$tit = msg("titulo");

	/** Comandos de Edicao */
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	echo '</div>';	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			echo 'Salvo';
			require("../close.php");
		}

?>