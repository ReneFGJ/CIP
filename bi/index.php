<?
$breadcrumbs=array();
require("cab_bi.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

array_push($menu,array('P�s-Gradua��o','Programas de P�s-Gradua��o (cronol�gico)','pos_programas_cronologico.php'));
array_push($menu,array('P�s-Gradua��o','Notas dos Programas de P�s-Gradua��o (cronol�gico)','pos_programas_cronologico_notas.php'));
array_push($menu,array('P�s-Gradua��o','Fluxo Discente','pos_programas_flxuo_discente.php'));
array_push($menu,array('P�s-Gradua��o','Capta��o de recursos','indicador_02.php'));
array_push($menu,array('P�s-Gradua��o','Mobilidade',''));
array_push($menu,array('P�s-Gradua��o','__Mobilidade docente (outgoing)','pos_mobilidade_docente.php'));
array_push($menu,array('P�s-Gradua��o','__Mobilidade docente (incoming)','pos_mobilidade_docente_in.php'));
array_push($menu,array('P�s-Gradua��o','__Mobilidade discente (outgoing)','pos_mobilidade_discente.php'));
array_push($menu,array('P�s-Gradua��o','__Mobilidade discente (incoming)','pos_mobilidade_discente_in.php'));

array_push($menu,array('P�s-Gradua��o','Produ��o','pos_producao.php'));
array_push($menu,array('P�s-Gradua��o','Capta��o','pos_captacao.php'));

/* pos_producao.php */
//ho $bi->producao_docente();

array_push($menu,array('Inicia��o Cient�fica','Indicadores Bolsas PIBIC','pibic_indicadores.php?dd1=PIBIC'));
array_push($menu,array('Inicia��o Cient�fica','Indicadores Bolsas PIBIC_EM(Jr)','pibic_indicadores_bolsas.php?dd1=PIBIC_EM'));

array_push($menu,array('Ci�ncia sem Fronteiras','Cursos','scf_cursos.php'));

array_push($menu,array('Professores','Sobre o corpo docente','rel_docente_about.php'));

array_push($menu,array('Isen��o','Isen��o de estudantes por capta��o de projetos','bonificacao_isencao.php'));

array_push($menu,array('Indicadores da Pesquisa','Pesquisadores',''));
array_push($menu,array('Indicadores da Pesquisa','__Pesquisadores da Institui��o','pesquisadores_instituicao.php'));


array_push($menu,array('Capta��o de recursos','__Capta��o de projetos - Vigentes','captacao_ano_metodo_1.php?dd4=1&dd3=001&dd5=0&dd1=200301&dd2='.date("Y01").'&acao=busca'));
array_push($menu,array('Capta��o de recursos','__Capta��o de projetos - Capta��o do Ano','captacao_ano_metodo_1.php?dd4=1&dd3=002&dd5=0&dd1=200301&dd2='.date("Y01").'&acao=busca'));

array_push($menu,array('Capta��o de recursos institucional','__Capta��o de projetos - Vigentes','captacao_ano_metodo_1.php?dd7=1&dd4=1&dd3=001&dd5=0&dd1=200301&dd2='.date("Y01").'&acao=busca'));
array_push($menu,array('Capta��o de recursos institucional','__Capta��o de projetos - Capta��o do Ano','captacao_ano_metodo_1.php?dd7=1&dd4=1&dd3=002&dd5=0&dd1=200301&dd2='.date("Y01").'&acao=busca'));
//array_push($menu,array('Capta��o de recursos','__Capta��o de projetos - Divididos pela vig�ncia','captacao_ano_metodo_1.php?dd4=1&dd3=003&dd5=0&dd1=200301&dd2='.date("Y01").'&acao=busca'));

if (($perfil->valid('#CPS')))
	{
	array_push($menu,array('Relat�rio da P�s-Gradua��o','Relat�rio de metas','indicador_01.php'));
	array_push($menu,array('Relat�rio da P�s-Gradua��o','__Exportar Excel','indicador_01_excel.php'));
	
	array_push($menu,array('Relat�rio da P�s-Gradua��o','Capta��o por programas & escolas','indicador_02.php'));
	array_push($menu,array('Relat�rio da P�s-Gradua��o','__Exportar Excel','indicador_02_excel.php'));
	//array_push($menu,array('Relat�rio da P�s-Gradua��o','__Exportar Excel','indicador_02_excel.php'));	
	}

array_push($menu,array('Relat�rio da P�s-Gradua��o','Projetos Vigentes por programas','pos_graduacao_resume.php'));
	
if (($perfil->valid('#CPI#SPI')))
	{
	array_push($menu,array('Relat�rio de Submiss�es '.date("Y"),'Relat�rio de metas','indicador_pibic_01.php'));
	array_push($menu,array('Relat�rio de Submiss�es '.date("Y"),'__Exportar Excel','indicador_pibic_01_excel.php'));
	}	

///////////////////////////////////////////////////// redirecionamento
?>

<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="index.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?php
	$tela = menus($menu,"3");

require("../foot.php");	
?>