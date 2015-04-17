<?
require("cab.php");

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

echo $hd->menu();
echo '<div id="conteudo">';

	/* Dados da Classe */
	require("_class/_class_submit_cp4.php");
	$clx = new campo_04;
	//$clx->structure();
	$tabela = $clx->tabela;
	
	/* Não alterar - dados comuns */
	$label = msg($tabela);
	$http_edit = 'submit_campo_04_ed.php'; 
	$http_ver = 'submit_campo_04_ver.php'; 
	if ($user_nivel > 1)
		{
			$editar = True;
		}
	$http_redirect = 'submit_campo_04_opcionais.php';
	$clx->row();
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	if ($order == 0) { $order  = $cdf[1]; }
	
	$tab_max = '98%';
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';
		
echo '</div>';
require("foot.php");		
?> 