<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));

require("cab.php");
require($include.'sisdoc_windows.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require("_ged_config_docs.php");
global $acao,$dd,$cp,$tabela;
$ged->protocol = '';

echo $ged->filelist_link();
require("../foot.php");	
?>