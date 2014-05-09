<?
$breadcrumbs=array();
$include = '../';
require("../db.php");

require("../_class/_class_lattes.php");

require("../_class/_class_bi.php");
$bi = new bi;

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-type: application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=estatistica_".date("Y-m-d").".xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

/* Professores com projetos de captacao aprovados e andamento por vigência
 * Campus, escola, programa
 */
echo '<h1>Captação Vigente - Programa de Pós</h1>';
echo '<h3>'.$bi->ano_ini.' - '.$bi->ano_fim.'</h3>';
echo utf8_encode($bi->captacao_vigente_por_programa());

 /* Captacao de Recursos via Agência d Fomento e Governamentais
  * Campus, escola, programa
  */

echo '<h1>Captação Vigente - Escola</h1>';
echo '<h3>'.$bi->ano_ini.' - '.$bi->ano_fim.'</h3>';
echo utf8_encode($bi->captacao_vigente_por_escola());


?>