<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('index.php','principal'));
array_push($breadcrumbs, array('submissao.php','Submissão'));

require("cab_semic.php");
require($include.'sisdoc_debug.php');
require("../_class/_class_semic.php");
$page = 'semic_submissao_detalhe_semic.php';

echo '<h1>Lista de Submissões de trabalhos</h1>';
$semic = new semic;
$semic->tabela = "semic_ic_trabalho";
$semic->tabela_autor = "semic_ic_trabalho_autor";
echo $semic->submit_list($dd[1],'*',$page);

require("../foot.php");
?>


