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
	
	array_push($menu,array('Central de Declara��es','Declara��o de participa��o do aluno (SEMIC/IC)','declaracao_central.php?tp=1'));
	array_push($menu,array('Central de Declara��es','Declara��o de orientador',''));
	array_push($menu,array('Central de Declara��es','Declara��o de avaliador','declaracao_avaliador.php?tp=1'));
	
	array_push($menu,array('Central de Declara��es','Resumo das declara��es','declaracao_lista.php?tp='.date("Y")));
	
	array_push($menu,array('Participa��o','Aus�ncia de Participa��o de alunos','semic_participacao_alunos.php?dd1=N'));
	
	array_push($menu,array('Classifica��o','Quartis','semic_quartis.php'));
	
	array_push($menu,array('Anais do Semin�rio','Trabalhos','semic_apresentacao.php'));
	
	//array_push($menu,array('Anais do Semin�rio','Exportar (IC)','semic_exportar_anais.php'));
	//array_push($menu,array('Anais do Semin�rio','Exportar (POS)','semic_exportar_mostra.php'));
	//array_push($menu,array('Anais do Semin�rio','Exportar (CICPG)','semic_exportar_congresso.php'));
	array_push($menu,array('Anais do Semin�rio','Atualiza o site','semic_trabalhos_semic.php'));
	array_push($menu,array('Anais do Semin�rio','Inserir autores sem nome','semic_autores_inserir.php'));

///////////////////////////////////////////////////// redirecionamento
	$tela = menus($menu,"3");

require("../foot.php");	
?>