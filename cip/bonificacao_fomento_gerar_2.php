<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

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

$ano = 2011;
echo '<h2>Gerar Bonificações - 3%</h2>';
echo '<p>Bonificação de projetos do valor aplicado na PUCPR em 3%, para projetos homologados pelo professor e coordenador.<p>';
echo $bon->lista_para_bonificar_2($ano);

require("../foot.php");	?>