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
array_push($menu,array(msg('submissoes'),'__Não finalizados','submissao_nao_finalizadas.php'));
array_push($menu,array(msg('submissoes'),'__Validação de submissão','submissao_validacao.php'));
array_push($menu,array(msg('submissoes'),'__Aceitos para avaliação','submissao_aceito_para_avaliacao.php'));
array_push($menu,array(msg('submissoes'),'__Projetos encaminhados para correção do professor','submissao_para_correcao.php'));


array_push($menu,array(msg('submissoes'),'Projetos por áreas estratégicas','submissao_areas.php'));
array_push($menu,array(msg('submissoes'),'__Detalhes da Submissão','submissao_detalhe.php'));
array_push($menu,array(msg('submissoes'),'__Projetos não finalizados (em Submissão)','submissao_detalhe_sub.php'));



array_push($menu,array(msg('pre-avaliacao'),'Validação da submissão','submissao_detalhe.php?dd1=B'));
array_push($menu,array(msg('pre-avaliacao'),'Projetos para idicação','submissao_detalhe.php?dd1=C'));
array_push($menu,array(msg('pre-avaliacao'),'__Projetos idicados','submissao_detalhe.php?dd1=D'));
array_push($menu,array(msg('pre-avaliacao'),'Projetos para Coordenação','submissao_detalhe.php?dd1=P'));
array_push($menu,array(msg('pre-avaliacao'),'Projetos para TI','submissao_detalhe.php?dd1=T'));
array_push($menu,array(msg('pre-avaliacao'),'Avaliações Finalizadas','submissao_detalhe.php?dd1=E'));

array_push($menu,array('Em avaliação','Enviados para avaliação','submissao_detalhe.php?dd1=D'));
array_push($menu,array('Em avaliação','Resumo dos status','submissao_avaliacao_resumo.php'));

array_push($menu,array(msg('avaliacao'),'Avaliações em aberto','pareceres_gestao_av1.php'));
array_push($menu,array(msg('avaliacao'),'__Comunicar avaliadores sobre não avaliados','pareceres_gestao_av1b.php'));
array_push($menu,array(msg('avaliacao'),'Avaliações finalizadas','pareceres_gestao_av2.php'));

if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Edital '.date("Y"),'Gerar dados para o edital','pibic_edital_gerar.php'));		
	array_push($menu,array('Edital '.date("Y"),'Motagem do edital','pibic_edital.php'));
	
	array_push($menu,array('Edital '.date("Y"),'Áreas estratégicas','pibic_edital_estrategicas.php'));
	array_push($menu,array('Edital '.date("Y"),'Edital (PIBIC) - Professores com bolsas','pibic_edital_professores.php'));
	
	} 

array_push($menu,array('Implementação de Bolsas (Fase de Implementação)','Bolsas não Implementadas de Bolsas (PIBIC)','pibic_implementacao_bolsas.php?dd1=PIBIC'));	
array_push($menu,array('Implementação de Bolsas (Fase de Implementação)','Bolsas não Implementadas de Bolsas (PIBITI)','pibic_implementacao_bolsas.php?dd1=PIBITI'));	

	


echo '<TABLE width="710" align="center" border="0">
		<TR>';
		$tela = menus($menu,"3");
echo '</table>';
require("../foot.php");	
?>