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

/* Professores com projetos de captacao aprovados e andamento
 * Campus, escola, programa
 */
echo utf8_encode($bi->professor_com_captacao());

 /* Captacao de Recursos via Agкncia d Fomento e Governamentais
  * Campus, escola, programa
  */
echo utf8_encode($bi->professor_com_captacao_ag_gov());

 /* Mobilidade Internacional Docente - SS
  * Campus, escola, programa
  */
echo utf8_encode($bi->mobilidade_docente()); 

 /* Mobilidade Internacional Discente - SS 
  * Campus, escola, programa
  */
echo utf8_encode($bi->mobilidade_discente());
 /* Nнvel de produзгo Qualificada - PPG
  * Campus, escola, programa
  */
echo utf8_encode($bi->producao_docente());

?>