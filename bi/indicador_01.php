<?
$breadcrumbs=array();
require("cab_bi.php");

require("../_class/_class_lattes.php");

require("../_class/_class_bi.php");
$bi = new bi;
$bi->ano_ini = 2013;
$bi->ano_fim = 2014;
/* Professores com projetos de captacao aprovados e andamento
 * Campus, escola, programa
 */
echo $bi->professor_com_captacao();

/* Professores com projetos de captacao aprovados e andamento por vigкncia
 * Campus, escola, programa
 */
echo $bi->professor_com_captacao_vigente();

 /* Captacao de Recursos via Agкncia d Fomento e Governamentais
  * Campus, escola, programa
  */
echo $bi->professor_com_captacao_ag_gov();

 /* Mobilidade Internacional Discente - SS 
  * Campus, escola, programa
  */
echo $bi->mobilidade_discente();
 /* Mobilidade Internacional Docente - SS
  * Campus, escola, programa
  */
echo $bi->mobilidade_docente(); 
 /* Nнvel de produзгo Qualificada - PPG
  * Campus, escola, programa
  */
echo $bi->producao_docente();
 
require("../foot.php");	
?>