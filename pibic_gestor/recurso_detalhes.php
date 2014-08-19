<?php
require("cab.php");
require($include.'sisdoc_menus.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
if (strlen($dd[0])==0)
	{
		redirecina("recurso_lista.php");
	}
require("_ged_config_submit_pibic.php");


	/* Dados da Classe */
	require ("../_class/_class_pibic_recurso.php");
	$recurso = new recurso;

	$recurso->le($dd[0]);
	
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

	$tab_max = "98%";
require ("../_class/_class_pibic_projetos_v2.php");
$prj = new projetos;

	require($include.'_class_form.php');
	$form = new form;

$sql = "select * from pibic_submit_documento where doc_protocolo = '" . $recurso->protocolo . "'";
$rlt = db_query($sql);
if ($line = db_read($rlt)) {	
	
	echo $prj -> mostra_plano_aluno($line);
}

	echo $recurso->line['rec_data'];

	echo $recurso->mostra();
	
	$cp = $recurso->cp_resultado();
	$tabela = $recurso->tabela;
	
	$tela = $form->editar($cp,$tabela);
	
	if ($form->saved > 0)
		{
			redirecina("recurso_lista.php");
		} else {
			echo $tela;			
		}	
	
require("../foot.php");	
?>