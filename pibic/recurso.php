<?php
require ("cab_pibic.php");
if (strlen($dd[1]) == 0) {
	echo 'Protocolo não informado';
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
}
echo $hd -> foot();
?>
