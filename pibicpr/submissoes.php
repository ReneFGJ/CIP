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
array_push($menu,array(msg('submissoes'),'__Planos de aluno','submissao_plano.php'));

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
array_push($menu,array(msg('pre-avaliacao'),'Situação das avaliações','submissao_indicacao_unicao.php'));
array_push($menu,array(msg('pre-avaliacao'),'Avaliações Finalizadas','submissao_detalhe.php?dd1=E'));

array_push($menu,array(msg('pre-avaliacao'),'Avaliações em aberto','submissao_avaliacao_aberta.php'));



array_push($menu,array('Em avaliação','Enviados para avaliação','submissao_detalhe.php?dd1=D'));
array_push($menu,array('Em avaliação','Resumo dos status','submissao_avaliacao_resumo.php'));

array_push($menu,array(msg('avaliacao'),'Avaliações em aberto','pareceres_gestao_av1.php'));
array_push($menu,array(msg('avaliacao'),'__Comunicar avaliadores sobre não avaliados','pareceres_gestao_av1b.php'));
array_push($menu,array(msg('avaliacao'),'Avaliações finalizadas','pareceres_gestao_av2.php'));

if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Edital '.date("Y"),'Gerar dados para o edital','pibic_edital_gerar.php'));
	array_push($menu,array('Edital '.date("Y"),'Montar Edital (PIBIC)','pibic_edital_3_pibic.php'));
	array_push($menu,array('Edital '.date("Y"),'Montar Edital (PIBITI)','pibic_edital_3_pibiti.php'));
	array_push($menu,array('Edital '.date("Y"),'Montar Edital (PIBIC Jr)','pibic_edital_3_pibicem.php'));		
	array_push($menu,array('Edital '.date("Y"),'Projetos do Edital','pibic_edital.php'));
	
	array_push($menu,array('Edital '.date("Y"),'Áreas estratégicas','pibic_edital_estrategicas.php'));
	array_push($menu,array('Edital '.date("Y"),'Edital (PIBIC) - Professores com bolsas','pibic_edital_professores.php'));
	
	array_push($menu,array('Edital '.date("Y"),'Projetos avaliados com víes PIBITI','pibic_vies_pibiti.php'));

	array_push($menu,array(	'Edital (Publicação)','Edital (PIBIC) - Resultado Final','edital.php?dd0=H&dd1=PIBIC&dd2='.date("Y").'&printer=S'));
	array_push($menu,array(	'Edital (Publicação)','Edital (PIBITI) - Resultado Final','edital_pibiti.php?dd0=H&dd1=PIBITI&dd2='.date("Y").'&printer=S'));
	array_push($menu,array(	'Edital (Publicação)','Edital (PIBIC_EM) - Resultado Final','edital_pibic_em.php?dd0=H&dd1=PIBICE&dd2='.date("Y").'&printer=S'));
	array_push($menu,array(	'Edital (Publicação)','Edital (Inclusão Social) - Resultado Final','edital_inclusao.php?dd0=H&dd1=PIBIC&dd2='.date("Y").'&printer=S'));
	
	array_push($menu,array(	'Edital (Recursos)','Recursos para o edital','recurso_lista.php'));
	array_push($menu,array(	'Edital (Recursos)','__Cadastrar Recurso','recurso.php'));	
		
	} 

array_push($menu,array('Implementação de Bolsas (Fase de Implementação)','Bolsas não Implementadas de Bolsas (PIBIC)','pibic_implementacao_bolsas.php?dd1=PIBIC'));	
array_push($menu,array('Implementação de Bolsas (Fase de Implementação)','Bolsas não Implementadas de Bolsas (PIBITI)','pibic_implementacao_bolsas.php?dd1=PIBITI'));	

	


echo '<TABLE width="710" align="center" border="0">
		<TR>';
		$tela = menus($menu,"3");
echo '</table>';
require("../foot.php");	
?>