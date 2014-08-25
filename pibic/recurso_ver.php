<?php
require ("cab_pibic.php");
if (strlen($dd[0]) == 0) {
	echo 'Protocolo não informado';
	redirecina("index.php");
	exit ;
}

require("_ged_config_submit_pibic.php");

require ("../_class/_class_pibic_recurso.php");
$recurso = new recurso;
$tabela = $recurso->tabela;

$id = $dd[0];
$chk = checkpost($dd[0]);
if ($dd[90] != $chk)
	{
		redireciona("index.php");
		exit;
	}
	
$recurso->le($dd[0]);
$proto = $recurso->protocolo;

require ("../_class/_class_pibic_projetos_v2.php");
$prj = new projetos;

$sql = "select * from pibic_submit_documento where doc_protocolo = '" . $proto . "'";
$rlt = db_query($sql);
if ($line = db_read($rlt)) {
	echo $prj -> mostra_plano_aluno($line);
	//$prj->le('',$dd[1]);
	echo $recurso->mostra_recurso_professor($recurso);
}
echo $hd -> foot();
?>
