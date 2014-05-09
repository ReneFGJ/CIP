<?
$breadcrumbs=array();
$include = '../';
require("../db.php");

require("../_class/_class_pibic_projetos.php");
require("../_class/_class_bi.php");
$bi = new bi;

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-type: application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=estatistica_".date("Y-m-d").".xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

/* Professores com projetos de captacao aprovados e andamento
 * Campus, escola, programa
 */
echo ($bi->pibic_planos_submetidos());

 /* Captacao de Recursos via Agência d Fomento e Governamentais
  * Campus, escola, programa
  */

?>