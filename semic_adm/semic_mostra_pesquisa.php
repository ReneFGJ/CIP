<?
$breadcrumbs=array();
require("cab_semic.php");

require('../_class/_class_semic.php');
$semic = new semic;

echo $semic->submit_resume_mostra_adms('semic_submissao_lista_mostra.php');

echo $semic->lista_trabalhos_pos_graduacao(date("Y"));

require("../foot.php");	
?>