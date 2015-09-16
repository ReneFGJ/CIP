<?php

function msg($t)
	{
		$CI = &get_instance();
		if (strlen($CI->lang->line($t)) > 0)
			{
				return($CI->lang->line($t));
			} else {
				return($t);
			}
	}
$lang['versao'] = 'v0.15.25';

/* Formulário de consulta */
$lang['busca'] = 'BUSCA';

/* Top MENU */
$lang['top_menu_01'] = 'SEMIC';
$lang['top_menu_02'] = 'Programação';
$lang['top_menu_03'] = 'Expediente';
$lang['top_menu_04'] = 'Sumário Geral';
$lang['top_menu_05'] = 'Edições Anteriores';
$lang['top_menu_06'] = 'Instruções aos autores';
$lang['top_menu_07'] = 'FAQ';

$lang['whats_semic'] = 'O que é o SEMIC?';
$lang['whats_semic_text'] = 'O Seminário de Iniciação Científica (SEMIC) da PUCPR é um evento aberto à comunidade, em que são exibidos os trabalhos de Iniciação Científica desenvolvidos pelos alunos ao longo do ano.';
$lang['read_more'] = '+ leia mais';

$lang['modalidade_edital'] = 'Modalidades de IC';

$lang['cab_expediente_01'] = 'Apoiadores do evento';
$lang['about_system'] = 'Sobre o evento';
$lang['contact_system'] = 'Contato com a organização';

$lang['programmation'] = 'Programação';
$lang['casaestrela'] = 'Casa Estrela';
$lang['link_semic'] = 'SEMIC';
$lang['model_doc'] = 'modelos de documentos';

//footer
$lang['colaboracao'] = 'Agências de fomento';
$lang['apoio'] = 'Apoio';
$lang['ies'] = 'IES';

?>
