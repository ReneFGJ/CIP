<?
$breadcrumbs=array();
require("cab_bi.php");

require($include."_class_form.php");
$form = new form;

require("../_class/_class_lattes.php");

require("../_class/_class_bi.php");
$bi = new bi;
/* Professores com projetos de captacao aprovados e andamento
 * Campus, escola, programa
 */
//echo $bi->professor_com_captacao();

/* Professores com projetos de captacao aprovados e andamento por vig�ncia
 * Campus, escola, programa
 */
echo '<h1>Capta��o Vigente - Programa de P�s</h1>';

 /* Captacao de Recursos via Ag�ncia d Fomento e Governamentais
  * Campus, escola, programa
  */
  
if (strlen($acao) == 0)
	{
		$dd[2] = date("Y")-2;
		$dd[3] = date("Y");
	}
$cp = array();
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$A','','Delimita��o temporal (data sa�da)',False,True));
array_push($cp,array('$[1990-'.date("Y").']D','','In�cio do recorte',True,True));
array_push($cp,array('$[1990-'.date("Y").']D','','Final do recorte',True,True));

$tela = $form->editar($cp,'');

if ($form->saved == 0)
	{
		echo $tela;	
	} else {
		$ano1 = $dd[2];
		$ano2 = $dd[3];
		$bi->ano_ini = $ano1;
		$bi->ano_fim = $ano2;
		echo '<h4>Ano de apura��o '.$ano1.'-'.$ano2.'</h4>';
		echo $bi->captacao_vigente_por_programa($an);
		echo $bi->captacao_vigente_por_escola();
	}  

require("../foot.php");	
?>