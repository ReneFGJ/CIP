<?php
require ("cab.php");

if (strlen($dd[1]) == 0) {
	require($include.'_class_form.php');
	$form = new form;
	
	$cp = array();
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$S8','','Protocolo',True,True));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	$tela = $form->editar($cp,'');
	echo $tela;
	if ($form->saved > 0)
		{
			redirecina(page().'?dd1='.$dd[1]);
		}
	exit ;
}

require("_ged_config_submit_pibic.php");

require ("../_class/_class_pibic_recurso.php");
$recurso = new recurso;
$tabela = $recurso->tabela;

require ("../_class/_class_pibic_projetos_v2.php");
$prj = new projetos;

$sql = "select * from pibic_submit_documento where doc_protocolo = '" . $dd[1] . "'";
$rlt = db_query($sql);
if ($line = db_read($rlt)) {
	echo $prj -> mostra_plano_aluno($line);
	//$prj->le('',$dd[1]);

	$cp = $recurso->cp();

	require ($include . '_class_form.php');
	$form = new form;
	
	$tela = $form -> editar($cp, $tabela);

	echo '<h1>Solicitação de reconsideração de avaliação</h1>';
	echo $tela;
	if ($form->saved > 0)
		{
			redirecina('recurso_lista.php');
		}
}
echo $hd -> foot();
?>
