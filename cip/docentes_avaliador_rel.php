<?
$breadcrumbs=array();
$page = $_SERVER['SCRIPT_NAME'];
while (strpos($page,'/') > 0)
	{
		$page = substr($page,strpos($page,'/')+1,500);
	}
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));
array_push($breadcrumbs, array($page,'docentes'));

require("cab.php");
require($include.'sisdoc_colunas.php');
require('../_class/_class_docentes.php');
$prof = new docentes;

if ($dd[0]=='1')
	{
		echo '<H2>Comitê Local<h2>';
		$rlt = $prof->rel_prof_comite('1');
	} 
if ($dd[0]=='2')
	{
		echo '<H2>Comitê Gestor<h2>';
		$rlt = $prof->rel_prof_comite('2');
	}

echo $prof->rel_prof_mostra($rlt);

require("../foot.php");	?>