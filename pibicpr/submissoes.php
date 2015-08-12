<?php
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('inicia��o cient�fica')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu CIP')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Submiss�es</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';

//////////////////// MANAGERS ///////////////////////////////
$menu = array();
//Cria uma barra com texto
//array_push($cp,array('$A8','','Selecione um item nos menus abaixo',False,True,''));

array_push($menu,array(msg('submissoes'),'Resumo',''));
//array_push($menu,array(msg('submissoes'),'__Cockpit','submissao_cockpit.php'));
//array_push($menu,array(msg('submissoes'),'__Cockpit_02','submissao_cockpit.php'));
	
if (($perfil->valid('#TST')) or ($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
		array_push($menu,array(msg('submissoes'),'__Cockpit','pibic_seleciona_anos.php'));
	}
		if (($perfil->valid('#TST'))) 
	{
		array_push($menu,array(msg('submissoes'),'__Resumo projetos aprovados','pibic_selecionaAno.php'));
	}

array_push($menu,array(msg('submissoes'),'Projetos e Planos',''));
array_push($menu,array(msg('submissoes'),'__Planos por professor / titula��o','submissao_professor_titulacao.php'));
array_push($menu,array(msg('submissoes'),'__Projetos do professor','submissao_professor.php'));
array_push($menu,array(msg('submissoes'),'__Planos de aluno','submissao_plano.php'));

 
array_push($menu,array(msg('submissoes'),'Projetos submetidos',''));
array_push($menu,array(msg('submissoes'),'__N�o finalizados','submissao_nao_finalizadas.php'));
array_push($menu,array(msg('submissoes'),'__Valida��o de submiss�o','submissao_validacao.php'));
array_push($menu,array(msg('submissoes'),'__Aceitos para avalia��o','submissao_aceito_para_avaliacao.php'));
array_push($menu,array(msg('submissoes'),'__Projetos encaminhados para corre��o do professor','submissao_para_correcao.php'));
array_push($menu,array(msg('submissoes'),'__Agrupar Planos de Alunos (projetos duplicados)','submissao_agrupar_plano.php')); 
array_push($menu,array(msg('submissoes'),'__Detalhes da Submiss�o','submissao_detalhe.php'));


array_push($menu,array(msg('submissoes'),'Projetos em Submiss�o',''));
array_push($menu,array(msg('submissoes'),'__Projetos n�o finalizados','submissao_detalhe_sub.php'));	


array_push($menu,array(msg('pre-avaliacao'),'Avalia��es Finalizadas','submissao_detalhe.php?dd1=E'));
array_push($menu,array(msg('pre-avaliacao'),'Avalia��es em aberto','submissao_avaliacao_aberta.php'));
array_push($menu,array(msg('pre-avaliacao'),'Avalia��es em aberto (externos)','submissao_avaliacao_aberta_externo.php'));
array_push($menu,array(msg('pre-avaliacao'),'Avalia��es em aberto por �rea','submissao_avaliacao_aberta_por_area.php'));	
array_push($menu,array(msg('pre-avaliacao'),'Projetos para indica��o','submissao_detalhe.php?dd1=C'));
array_push($menu,array(msg('pre-avaliacao'),'Projetos indicados','submissao_detalhe.php?dd1=D'));
array_push($menu,array(msg('pre-avaliacao'),'Projetos para Coordena��o','submissao_detalhe.php?dd1=P'));
array_push($menu,array(msg('pre-avaliacao'),'Projetos para TI','submissao_detalhe.php?dd1=T'));
array_push($menu,array(msg('pre-avaliacao'),'Situa��o das avalia��es','submissao_indicacao_unicao.php'));
array_push($menu,array(msg('pre-avaliacao'),'Valida��o da submiss�o','submissao_detalhe.php?dd1=B'));


array_push($menu,array('Em avalia��o','Enviados para avalia��o','submissao_detalhe.php?dd1=D'));
array_push($menu,array('Em avalia��o','Resumo dos status','submissao_avaliacao_resumo.php'));

array_push($menu,array(msg('avaliacao'),'Avalia��es em aberto','pareceres_gestao_av1.php'));
array_push($menu,array(msg('avaliacao'),'__Comunicar avaliadores sobre n�o avaliados','pareceres_gestao_av1b.php'));
array_push($menu,array(msg('avaliacao'),'Avalia��es finalizadas','pareceres_gestao_av2.php'));

if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Edital '.date("Y"),'Gerar dados para o edital','pibic_edital_gerar.php'));
	array_push($menu,array('Edital '.date("Y"),'Montar Edital (PIBIC)','pibic_edital_3_pibic.php'));
	array_push($menu,array('Edital '.date("Y"),'Montar Edital (PIBITI)','pibic_edital_3_pibiti.php'));
	array_push($menu,array('Edital '.date("Y"),'Montar Edital (PIBIC Jr)','pibic_edital_3_pibicem.php'));		
	array_push($menu,array('Edital '.date("Y"),'Projetos do Edital','pibic_edital.php'));	
	array_push($menu,array('Edital '.date("Y"),'Edital (PIBIC) - Professores com bolsas','pibic_edital_professores.php'));
	array_push($menu,array('Edital '.date("Y"),'Projetos avaliados com v�es PIBITI','pibic_vies_pibiti.php'));


	array_push($menu,array('Edital (Publica��o)','Edital (PIBIC) - Resultado Final','edital.php?dd0=H&dd1=PIBIC&dd2='.date("Y").'&printer=S'));
	array_push($menu,array('Edital (Publica��o)','Edital (PIBITI) - Resultado Final','edital_pibiti.php?dd0=H&dd1=PIBITI&dd2='.date("Y").'&printer=S'));
	array_push($menu,array('Edital (Publica��o)','Edital (PIBIC_EM) - Resultado Final','edital_pibic_em.php?dd0=H&dd1=PIBICE&dd2='.date("Y").'&printer=S'));
	array_push($menu,array('Edital (Publica��o)','Edital (Inclus�o Social) - Resultado Final','edital_inclusao.php?dd0=H&dd1=PIBIC&dd2='.date("Y").'&printer=S'));
	
	array_push($menu,array('Edital (Recursos)','Recursos para o edital','recurso_lista.php'));
	array_push($menu,array('Edital (Recursos)','__Cadastrar Recurso','recurso.php'));	
		
	}	

array_push($menu,array('�reas Estrat�gicas','Exclusivo para Bolsa Juventude','pibic_edital_estrategicas_bolsas_juventudes.php?dd1='.date("Y").''));
array_push($menu,array('�reas Estrat�gicas','Planos de trabalhos (Doutorandos e P�s-Doutorandos)','submissao_escolas_x_doutorandos.php'));
array_push($menu,array('�reas Estrat�gicas','Resumo das �reas estrat�gicas','pibic_edital_estrategicas.php?dd1='.date("Y").''));
array_push($menu,array('�reas Estrat�gicas','Seleciona Projetos por �rea','submissao_areas.php'));
array_push($menu,array('�reas Estrat�gicas','Associa��o de curso � �reas','curso_area.php'));

array_push($menu,array('�rea do conhecimento','�rea do conhecimento SEMIC','rel_ajax_areadoconhecimento.php'));
array_push($menu,array('�rea do conhecimento','�rea do conhecimento Submissao','rel_ajax_areadoconhecimento_submissao.php'));
array_push($menu,array('�rea do conhecimento','Cadastro de �rea do conhecimento','areadoconhecimento.php'));

if ($perfil->valid('#TST') or ($perfil->valid('#PIB')))
	{
		array_push($menu,array('Documentos postados','Documentos CEP e CEUA postados','documentospostados.php'));
	}
	
echo '<TABLE width="710" align="center" border="0">
		<TR>';
		$tela = menus($menu,"3");
echo '</table>';
require("../foot.php");	
?>