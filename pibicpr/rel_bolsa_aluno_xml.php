<?

$export = $_GET["dd1"];
if (strlen($export) > 0) {
	$include = '../';
	require ("../db.php");
} else {
	require ("cab.php");
}

if (strlen($dd[0]) == 0) {
	require($include.'_class_form.php');
	$form = new form;
	
	$cp = array();
	array_push($cp,array('$[2000-'.date("Y").']D','','Ano de implementação',True,True));
	$tela = $form->editar($cp,'');
	echo $tela;
} else {
	require ($include . "sisdoc_data.php");
	require ("../_class/_class_pibic_bolsa_contempladas.php");
	$pb = new pibic_bolsa_contempladas;

	if ($dd[1] == 'XLS') {
		$file = 'relatorio de pibic - aluno - bolsa ' . date("d-m-Y") . '.xls';
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;filename=" . $file);
		header('Pragma: no-cache');
		header('Expires: 0');
		echo $pb -> relatorio_bolsas($dd[0]);
	} else {
		echo '<A HREF="' . page() . '?dd1=XLS&dd0='.$dd[0].'">Versão para Excel</A>';
		echo $pb -> relatorio_bolsas($dd[0]);
	}
}
require ("../foot.php");
?>