<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
//require("../include/_class_menus.php");
//$mn = new menus;
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
$bolsa = 'IC';

/////////////////////////////////////////////////// MANAGERS
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Relatório Parcial','Acompanhamento (resumo das entregas)','rp_acompanhamento.php'));
	
	array_push($menu,array('Relatório Parcial','Relatório não entregues',''));
	//array_push($menu,array('Relatório Parcial','__Enviar e-mail','rp_enviar_atividade.php'));
	array_push($menu,array('Relatório Parcial','__Relatórios não entregues','rp_relatorio_nao_entregues.php'));
	//array_push($menu,array('Relatório Parcial','__Gerar Atividade (processar)','rp_gerar_atividade.php'));
	} 

	array_push($menu,array('Relatório Parcial','Avaliação',''));
	array_push($menu,array('Relatório Parcial','__Acompanhamento Avaliação','rp_av_acompanhamento.php'));
	array_push($menu,array('Relatório Parcial','__Indicar avaliador','rp_indicar_avaliador.php?dd80='.$bolsa));

	array_push($menu,array('Relatório Parcial','__Avaliações indicadas','rp_av_indicadas.php?dd80='.$bolsa));
	array_push($menu,array('Relatório Parcial','__Link dos avaliadores (em aberto)','rp_indicar_avaliador_email.php?dd80='.$bolsa));

	//array_push($menu,array('Relatório Parcial','__Gerar Atividade (processar)','rp_indicar_gerar_atividade.php'));
	
	//array_push($menu,array('Relatório Parcial','__Indicar avaliador (correção do relatório)','rp_indicar_avaliador_correcao.php'));	
	//array_push($menu,array('Relatório Parcial','__Enviar e-mail para avaliador (correção)','rp_indicar_avaliador_email_2.php'));

	//array_push($menu,array('Parcial - Correções','__Enviar e-mail','rp_2_enviar_atividade.php'));
	//array_push($menu,array('Parcial - Correções','__Gerar Atividade (processar)','rp_2_gerar_atividade.php'));
	//array_push($menu,array('Parcial - Correções','__Enviar e-mail para orientadores que não postaram as correções','rp_correcoes_email.php'));

array_push($menu,array('Relatório Parcial (Correção)','Acompanhamento (resumo das entregas)','rpc_acompanhamento.php'));	
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Relatório Parcial (Correção)','Relatório não entregues',''));
	array_push($menu,array('Relatório Parcial (Correção)','__Enviar e-mail','rpc_enviar_atividade.php'));
	array_push($menu,array('Relatório Parcial (Correção)','__Relatórios não entregues','rpc_relatorio_nao_entregues.php'));
	array_push($menu,array('Relatório Parcial (Correção)','__Gerar Atividade (processar)','rpc_gerar_atividade.php'));
	} 

	array_push($menu,array('Relatório Parcial (Correção)','Avaliação',''));
	array_push($menu,array('Relatório Parcial (Correção)','__Acompanhamento Avaliação','rpc_av_acompanhamento.php'));
	array_push($menu,array('Relatório Parcial (Correção)','__Avaliações reprovadas','rp_reprovados.php'));	
	array_push($menu,array('Relatório Parcial (Correção)','__Indicar avaliador','rpc_indicar_avaliador.php?dd80='.$bolsa));

	array_push($menu,array('Relatório Parcial (Correção)','__Avaliações indicadas','rpc_av_indicadas.php?dd80='.$bolsa));
	array_push($menu,array('Relatório Parcial (Correção)','__Link dos avaliadores (em aberto)','rpc_indicar_avaliador_email.php?dd80='.$bolsa));
	
	array_push($menu,array('Relatório Parcial (Correção)','__Relatórios com dupla pendência','rpc_pendencias.php'));

	
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Relatório Final','__Acompanhamento','rf_acompanhamento.php'));
	array_push($menu,array('Relatório Final','____relatórios não entregues','rf_nao_entregues.php'));	
	array_push($menu,array('Relatório Final','__Enviar e-mail (atraso de entrega)','comunicacao.php?dd1=024&acao=post'));
	array_push($menu,array('Relatório Final','__Gerar Atividade (processar)','rf_gerar_atividade.php'));

	array_push($menu,array('Relatório Final','Avaliadores',''));
	array_push($menu,array('Relatório Final','__Indicar avaliador','rf_indicar_avaliador.php'));
	array_push($menu,array('Relatório Final','__Avaliações indicadas','rf_av_indicadas.php'));	
	array_push($menu,array('Relatório Final','__Enviar e-mail para avaliador','rf_indicar_avaliador_email.php'));
	
	array_push($menu,array('Relatório Final','Avaliações - Correções',''));
	array_push($menu,array('Relatório Final','__Avaliações reprovadas','rf_reprovados.php'));
	array_push($menu,array('Relatório Final','__Indicar reprovados para o comitê Gestor','rf_reprovados_indicar.php'));
	array_push($menu,array('Relatório Final','__Avaliações reprovadas indicadas','rfr_av_indicadas.php'));
	array_push($menu,array('Relatório Final','__Enviar e-mail para avaliador','rfr_indicar_avaliador_email.php'));
	array_push($menu,array('Relatório Final','____Revalidar reavaliações (trocar)','rfr_revalidar.php'));
	} 
	
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Resumo','__Acompanhamento','rm_acompanhamento.php'));
	array_push($menu,array('Resumo','__Enviar e-mail','comunicacao.php?dd1=028&acao=post'));
	array_push($menu,array('Resumo','__Resumo não entregues','resumo_nao_entregues.php'));	
	} 	
	
	
	array_push($menu,array('SEMIC','Planos de alunos sem ratificação SEMIC','rr_acompanhamento.php'));	
	array_push($menu,array('SEMIC','__Gerar Atividade (processar)','rr_gerar_atividade.php'));
	

	array_push($menu,array('SEMIC','SEMIC','semic.php'));


if ($perfil->valid('#ADM'))
	{
		array_push($menu,array('Pareceres','Indicados e não avaliados','rel_parecer_01.php'));	
	}	
///////////////////////////////////////////////////// redirecionamento
///////////////////////////////////////////////////// redirecionamento
echo '<img src="'.$http.'img/logo_ic_pibic.png">';
//echo $mn->menus($menu,"4");
//echo '<HR>OLA<HR>';
	$tela = menus($menu,"3");
require("../foot.php");	
?>