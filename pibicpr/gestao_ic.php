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
	array_push($menu,array('Relat�rio Parcial','Acompanhamento (resumo das entregas)','rp_acompanhamento.php'));
	
	array_push($menu,array('Relat�rio Parcial','Relat�rio n�o entregues',''));
	//array_push($menu,array('Relat�rio Parcial','__Enviar e-mail','rp_enviar_atividade.php'));
	array_push($menu,array('Relat�rio Parcial','__Relat�rios n�o entregues','rp_relatorio_nao_entregues.php'));
	//array_push($menu,array('Relat�rio Parcial','__Gerar Atividade (processar)','rp_gerar_atividade.php'));
	} 

	array_push($menu,array('Relat�rio Parcial','Avalia��o',''));
	array_push($menu,array('Relat�rio Parcial','__Acompanhamento Avalia��o','rp_av_acompanhamento.php'));
	array_push($menu,array('Relat�rio Parcial','__Indicar avaliador','rp_indicar_avaliador.php?dd80='.$bolsa));

	array_push($menu,array('Relat�rio Parcial','__Avalia��es indicadas','rp_av_indicadas.php?dd80='.$bolsa));
	array_push($menu,array('Relat�rio Parcial','__Link dos avaliadores (em aberto)','rp_indicar_avaliador_email.php?dd80='.$bolsa));

	//array_push($menu,array('Relat�rio Parcial','__Gerar Atividade (processar)','rp_indicar_gerar_atividade.php'));
	
	//array_push($menu,array('Relat�rio Parcial','__Indicar avaliador (corre��o do relat�rio)','rp_indicar_avaliador_correcao.php'));	
	//array_push($menu,array('Relat�rio Parcial','__Enviar e-mail para avaliador (corre��o)','rp_indicar_avaliador_email_2.php'));

	//array_push($menu,array('Parcial - Corre��es','__Enviar e-mail','rp_2_enviar_atividade.php'));
	//array_push($menu,array('Parcial - Corre��es','__Gerar Atividade (processar)','rp_2_gerar_atividade.php'));
	//array_push($menu,array('Parcial - Corre��es','__Enviar e-mail para orientadores que n�o postaram as corre��es','rp_correcoes_email.php'));

array_push($menu,array('Relat�rio Parcial (Corre��o)','Acompanhamento (resumo das entregas)','rpc_acompanhamento.php'));	
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Relat�rio Parcial (Corre��o)','Relat�rio n�o entregues',''));
	array_push($menu,array('Relat�rio Parcial (Corre��o)','__Enviar e-mail','rpc_enviar_atividade.php'));
	array_push($menu,array('Relat�rio Parcial (Corre��o)','__Relat�rios n�o entregues','rpc_relatorio_nao_entregues.php'));
	array_push($menu,array('Relat�rio Parcial (Corre��o)','__Gerar Atividade (processar)','rpc_gerar_atividade.php'));
	} 

	array_push($menu,array('Relat�rio Parcial (Corre��o)','Avalia��o',''));
	array_push($menu,array('Relat�rio Parcial (Corre��o)','__Acompanhamento Avalia��o','rpc_av_acompanhamento.php'));
	array_push($menu,array('Relat�rio Parcial (Corre��o)','__Avalia��es reprovadas','rp_reprovados.php'));	
	array_push($menu,array('Relat�rio Parcial (Corre��o)','__Indicar avaliador','rpc_indicar_avaliador.php?dd80='.$bolsa));

	array_push($menu,array('Relat�rio Parcial (Corre��o)','__Avalia��es indicadas','rpc_av_indicadas.php?dd80='.$bolsa));
	array_push($menu,array('Relat�rio Parcial (Corre��o)','__Link dos avaliadores (em aberto)','rpc_indicar_avaliador_email.php?dd80='.$bolsa));
	
	array_push($menu,array('Relat�rio Parcial (Corre��o)','__Relat�rios com dupla pend�ncia','rpc_pendencias.php'));

	
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Relat�rio Final','__Acompanhamento','rf_acompanhamento.php'));
	array_push($menu,array('Relat�rio Final','____relat�rios n�o entregues','rf_nao_entregues.php'));	
	array_push($menu,array('Relat�rio Final','__Enviar e-mail (atraso de entrega)','comunicacao.php?dd1=024&acao=post'));
	array_push($menu,array('Relat�rio Final','__Gerar Atividade (processar)','rf_gerar_atividade.php'));

	array_push($menu,array('Relat�rio Final','Avaliadores',''));
	array_push($menu,array('Relat�rio Final','__Indicar avaliador','rf_indicar_avaliador.php'));
	array_push($menu,array('Relat�rio Final','__Avalia��es indicadas','rf_av_indicadas.php'));	
	array_push($menu,array('Relat�rio Final','__Enviar e-mail para avaliador','rf_indicar_avaliador_email.php'));
	
	array_push($menu,array('Relat�rio Final','Avalia��es - Corre��es',''));
	array_push($menu,array('Relat�rio Final','__Avalia��es reprovadas','rf_reprovados.php'));
	array_push($menu,array('Relat�rio Final','__Indicar reprovados para o comit� Gestor','rf_reprovados_indicar.php'));
	array_push($menu,array('Relat�rio Final','__Avalia��es reprovadas indicadas','rfr_av_indicadas.php'));
	array_push($menu,array('Relat�rio Final','__Enviar e-mail para avaliador','rfr_indicar_avaliador_email.php'));
	array_push($menu,array('Relat�rio Final','____Revalidar reavalia��es (trocar)','rfr_revalidar.php'));
	} 
	
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Resumo','__Acompanhamento','rm_acompanhamento.php'));
	array_push($menu,array('Resumo','__Enviar e-mail','comunicacao.php?dd1=028&acao=post'));
	array_push($menu,array('Resumo','__Resumo n�o entregues','resumo_nao_entregues.php'));	
	} 	
	
	
	array_push($menu,array('SEMIC','Planos de alunos sem ratifica��o SEMIC','rr_acompanhamento.php'));	
	array_push($menu,array('SEMIC','__Gerar Atividade (processar)','rr_gerar_atividade.php'));
	

	array_push($menu,array('SEMIC','SEMIC','semic.php'));


if ($perfil->valid('#ADM'))
	{
		array_push($menu,array('Pareceres','Indicados e n�o avaliados','rel_parecer_01.php'));	
	}	
///////////////////////////////////////////////////// redirecionamento
///////////////////////////////////////////////////// redirecionamento
echo '<img src="'.$http.'img/logo_ic_pibic.png">';
//echo $mn->menus($menu,"4");
//echo '<HR>OLA<HR>';
	$tela = menus($menu,"3");
require("../foot.php");	
?>