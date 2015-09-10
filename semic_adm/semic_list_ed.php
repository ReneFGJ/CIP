<?php
require("cab_semic.php");

global $acao,$dd,$cp,$tabela_nota_trab;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'_class_form.php');
require($include.'sisdoc_data.php');

$form = new form;
$label = '<h1>SEMIC</h1>';

echo '<div id="conteudo">';

	/* Dados da Classe */
	require("../_class/_class_semic.php");
	$cl = new semic;
	$tabela = $cl->tabela_nota_trab;
	$cp = $cl->cp();
	
	$http_edit = page();
	$http_redirect = '../semic_adm/semic_list_ed.php';

	/** Comandos de Edicao */
	$tela = $form->editar($cp,$tabela);
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			redirecina('semic_list.php');
		} else {
			echo $tela;
		}
echo '</div>';		
require("../foot.php");	
?>

