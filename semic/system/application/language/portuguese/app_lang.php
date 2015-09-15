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

/* Formul�rio de consulta */
$lang['busca'] = 'BUSCA';

/* Top MENU */
$lang['top_menu_01'] = 'SEMIC';
$lang['top_menu_02'] = 'Programa��o';
$lang['top_menu_03'] = 'Expediente';
$lang['top_menu_04'] = 'Sum�rio Geral';
$lang['top_menu_05'] = 'Edi��es Anteriores';
$lang['top_menu_06'] = 'Instru��es aos autores';
$lang['top_menu_07'] = 'FAQ';

$lang['whats_semic'] = 'O que � o SEMIC?';
$lang['whats_semic_text'] = 'O Semin�rio de Inicia��o Cient�fica (SEMIC) da PUCPR � um evento aberto � comunidade, em que s�o exibidos os trabalhos de Inicia��o Cient�fica desenvolvidos pelos alunos ao longo do ano.';
$lang['read_more'] = '+ leia mais';

$lang['modalidade_edital'] = 'Modalidades de IC';

$lang['cab_expediente_01'] = 'Apoiadores do evento';
$lang['about_system'] = 'Sobre o evento';
$lang['contact_system'] = 'Contato com a organiza��o';

$lang['programmation'] = 'Programa��o';
$lang['casaestrela'] = 'Casa Estrela';
$lang['link_semic'] = 'SEMIC';
$lang['model_doc'] = 'modelos de documentos';

//footer
$lang['colaboracao'] = 'Ag�ncias de fomento';
$lang['apoio'] = 'Apoio';
$lang['ies'] = 'IES';

?>
