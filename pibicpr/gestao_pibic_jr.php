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


/////////////////////////////////////////////////// MANAGERS
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Relatório Parcial','Acompanhamento','rp_acompanhamento.php'));
	array_push($menu,array('Relatório Parcial','__Enviar e-mail','rp_enviar_atividade.php'));
	array_push($menu,array('Relatório Parcial','__Gerar Atividade (processar)','rp_gerar_atividade.php'));
	} 

	array_push($menu,array('Relatório Parcial','Relatório Parcial',''));
	array_push($menu,array('Relatório Parcial','__Resumo','pibic_em_resumo.php'));
	array_push($menu,array('Relatório Parcial','__Indicar avaliador','pibic_em_rp_indicar_avaliador.php'));

	array_push($menu,array('Relatório Parcial','__Avaliações indicadas','pibic_em_rp_av_indicadas.php'));
	array_push($menu,array('Relatório Parcial','__Enviar e-mail para avaliador','rp_indicar_avaliador_email.php'));

	array_push($menu,array('Relatório Parcial','__Gerar Atividade (processar)','rp_indicar_gerar_atividade.php'));
	
	array_push($menu,array('Relatório Parcial (Correção)','Indicar avaliador (correção do relatório)','rp_indicar_avaliador_correcao.php'));	
	array_push($menu,array('Relatório Parcial (Correção)','__Enviar e-mail para avaliador (correção)','rp_indicar_avaliador_email_2.php'));

	array_push($menu,array('Relatório Parcial','Relatório Final',''));
	array_push($menu,array('Relatório Parcial','__Resumo','pibic_em_resumo.php'));
	array_push($menu,array('Relatório Parcial','__Indicar avaliador','pibic_em_rf_indicar_avaliador.php'));

	array_push($menu,array('Relatório Parcial','__Avaliações indicadas','pibic_em_rf_av_indicadas.php'));
	array_push($menu,array('Relatório Parcial','__Enviar e-mail para avaliador','rf_indicar_avaliador_email.php'));

	array_push($menu,array('Relatório Parcial','__Gerar Atividade (processar)','rf_indicar_gerar_atividade.php'));


	array_push($menu,array('Parcial - Correções','__Enviar e-mail','rp_2_enviar_atividade.php'));
	array_push($menu,array('Parcial - Correções','__Gerar Atividade (processar)','rp_2_gerar_atividade.php'));
	array_push($menu,array('Parcial - Correções','__Enviar e-mail para orientadores que não postaram as correções','rp_correcoes_email.php'));


///////////////////////////////////////////////////// redirecionamento
echo '<img src="'.$http.'img/logo_ic_pibic_em.png">';
//echo $mn->menus($menu,"4");
//echo '<HR>OLA<HR>';
	$tela = menus($menu,"3");
require("../foot.php");	
?>