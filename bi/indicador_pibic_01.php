<?
$breadcrumbs=array();
require("cab_bi.php");

require("../_class/_class_bi.php");
$bi = new bi;

require("../_class/_class_csf.php");
$csf = new csf;
require("../_class/_class_pibic_projetos.php");
/* - N�mero de alunos em Projetos de Inicia��o Cient�fica (IC) Implementados.
 * Campus, escola, programa
 */
echo $bi->pibic_planos_submetidos();

echo $csf->estudantes_em_viagem_campus();
  
require("../foot.php");	
?>