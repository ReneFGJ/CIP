<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Capta��o'));

require("cab_cip.php");
require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

require("../_class/_class_captacao.php");
require("../_class/_class_docentes.php");
$doc = new docentes;
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
$cap = new captacao;
$cap->updatex();

$ano = '2010';
echo '<h2>Gerar Isen��es</h2>';
echo '<p>Isen��o de estudantes da P�s-Gradua��o, cujo orientadores tenham projeto de pesquisa de acordo com ato normativo 001/2012. N�o � valido para Apoio a eventos/organiza��o, P�s-Doc, Professor visitante e PROSUP, casos especiais s�o liberados pela diretoria de pesquisa.<p>';
echo $bon->lista_para_isentar($ano);

require("../foot.php");	?>