<?php
require("cab.php");
require($include.'sisdoc_menus.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array(msg('submissoes'),'Resumo Cockpit','submissao_cockpit.php'));
array_push($menu,array(msg('submissoes'),'__Projetos do professor','submissao_professor.php'));

array_push($menu,array(msg('submissoes'),'Projetos submetidos',''));
array_push($menu,array(msg('submissoes'),'__N�o finalizados','submissao_nao_finalizadas.php'));
array_push($menu,array(msg('submissoes'),'__Valida��o de submiss�o','submissao_validacao.php'));
array_push($menu,array(msg('submissoes'),'__Aceitos para avalia��o','submissao_aceito_para_avaliacao.php'));
array_push($menu,array(msg('submissoes'),'__Projetos encaminhados para corre��o do professor','submissao_para_correcao.php'));


array_push($menu,array(msg('submissoes'),'Projetos por �reas estrat�gicas','submissao_areas.php'));
array_push($menu,array(msg('submissoes'),'__Detalhes da Submiss�o','submissao_detalhe.php'));
array_push($menu,array(msg('submissoes'),'__Projetos n�o finalizados (em Submiss�o)','submissao_detalhe_sub.php'));



array_push($menu,array(msg('pre-avaliacao'),'Valida��o da submiss�o','submissao_detalhe.php?dd1=B'));
array_push($menu,array(msg('pre-avaliacao'),'Projetos para idica��o','submissao_detalhe.php?dd1=C'));
array_push($menu,array(msg('pre-avaliacao'),'__Projetos idicados','submissao_detalhe.php?dd1=D'));
array_push($menu,array(msg('pre-avaliacao'),'Projetos para Coordena��o','submissao_detalhe.php?dd1=P'));
array_push($menu,array(msg('pre-avaliacao'),'Projetos para TI','submissao_detalhe.php?dd1=T'));
array_push($menu,array(msg('pre-avaliacao'),'Avalia��es Finalizadas','submissao_detalhe.php?dd1=E'));

array_push($menu,array('Em avalia��o','Enviados para avalia��o','submissao_detalhe.php?dd1=D'));
array_push($menu,array('Em avalia��o','Resumo dos status','submissao_avaliacao_resumo.php'));

array_push($menu,array(msg('avaliacao'),'Avalia��es em aberto','pareceres_gestao_av1.php'));
array_push($menu,array(msg('avaliacao'),'__Comunicar avaliadores sobre n�o avaliados','pareceres_gestao_av1b.php'));
array_push($menu,array(msg('avaliacao'),'Avalia��es finalizadas','pareceres_gestao_av2.php'));

if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Edital '.date("Y"),'Gerar dados para o edital','pibic_edital_gerar.php'));		
	array_push($menu,array('Edital '.date("Y"),'Motagem do edital','pibic_edital.php'));
	
	array_push($menu,array('Edital '.date("Y"),'�reas estrat�gicas','pibic_edital_estrategicas.php'));
	array_push($menu,array('Edital '.date("Y"),'Edital (PIBIC) - Professores com bolsas','pibic_edital_professores.php'));
	
	} 

array_push($menu,array('Implementa��o de Bolsas (Fase de Implementa��o)','Bolsas n�o Implementadas de Bolsas (PIBIC)','pibic_implementacao_bolsas.php?dd1=PIBIC'));	
array_push($menu,array('Implementa��o de Bolsas (Fase de Implementa��o)','Bolsas n�o Implementadas de Bolsas (PIBITI)','pibic_implementacao_bolsas.php?dd1=PIBITI'));	

	


echo '<TABLE width="710" align="center" border="0">
		<TR>';
		$tela = menus($menu,"3");
echo '</table>';
require("../foot.php");	
?>