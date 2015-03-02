<?
$breadcrumbs=array();
require("cab_bi.php");

require("../_class/_class_lattes.php");

require($include.'_class_form.php');
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$[2010-'.date("Y").']','','Ano base',True,True));
$tela = $form->editar($cp,'');

if ($form->saved <= 0)
	{
		echo $tela;
		require("../foot.php");
		exit;
	}

echo '<A HREF="indicador_01_excel.php?dd1='.$dd[1].'">Exportar para excel</A>';

require("../_class/_class_bi.php");
$bi = new bi;
$bi->ano_ini = $dd[1];
$bi->ano_fim = $dd[1];
/* Professores com projetos de captacao aprovados e andamento
 * Campus, escola, programa
 */
echo $bi->professor_com_captacao();

/* Professores com projetos de captacao aprovados e andamento por vigência
 * Campus, escola, programa
 */
echo $bi->professor_com_captacao_vigente();

 /* Captacao de Recursos via Agência d Fomento e Governamentais
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
 /* Nível de produção Qualificada - PPG
  * Campus, escola, programa
  */
echo $bi->producao_docente($bi->ano_ini,$bi->ano_fim);
 
require("../foot.php");	
?>