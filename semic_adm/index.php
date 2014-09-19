<?
$breadcrumbs=array();
require("cab_semic.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

require('../_class/_class_semic.php');
$semic = new semic;

echo $semic->submit_resume_mostra_adms('semic_submissao_lista_mostra.php');
echo '<HR>';
$semic->tabela = "semic_ic_trabalho";
$semic->tabela_autor = "semic_ic_trabalho_autor";
echo $semic->submit_resume_mostra_adms('semic_submissao_lista_semic.php');
echo '<HR>';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

	array_push($menu,array('Controle de autoridade','Nomes dos autores','semic_autoridades.php'));
	
	array_push($menu,array('Central de Declarações','Declaração de participação do aluno (SEMIC/IC)','declaracao_central.php?tp=1'));
	array_push($menu,array('Central de Declarações','Declaração de orientador',''));
	array_push($menu,array('Central de Declarações','Declaração de avaliador','declaracao_avaliador.php?tp=1'));
	
	array_push($menu,array('Central de Declarações','Resumo das declarações','declaracao_lista.php?tp='.date("Y")));
	
	array_push($menu,array('Participação','Ausência de Participação de alunos','semic_participacao_alunos.php?dd1=N'));
	
	array_push($menu,array('Classificação','Quartis','semic_quartis.php'));

///////////////////////////////////////////////////// redirecionamento
	$tela = menus($menu,"3");

require("../foot.php");	
?>