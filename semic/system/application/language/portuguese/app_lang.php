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
$lang['bt_prog_cultural'] = 'Programação Cultural';
$lang['presentation'] = 'APRESENTAÇÃO';

$lang['whats_semic'] = 'O que é o SEMIC?';
$lang['whats_semic_text'] = 'O Seminário de Iniciação Científica (SEMIC) é um evento aberto à comunidade tendo em sua programação científica palestras, mesas-redondas, mini-cursos além das apresentações dos resultados de pesquisas realizados ao longo do ano. Desde 2014, o evento apresenta também uma programação cultural, entrelaçando a ciência, a arte e a cultura...';
$lang['read_more'] = '+ leia mais';

$lang['modalidade_edital'] = 'Modalidades de IC';

$lang['cab_expediente_01'] = 'Apoiadores do evento';
$lang['about_system'] = 'Sobre o evento';
$lang['contact_system'] = 'Contato com a organização';

$lang['programmation'] = 'Programação';
$lang['casaestrela'] = 'Casa Estrela';
$lang['link_semic'] = 'SEMIC';
$lang['model_doc'] = 'modelos de documentos';
$lang['summary'] = 'Sumário';

//footer
$lang['colaboracao'] = 'Agências de fomento';
$lang['apoio'] = 'Apoio';
$lang['ies'] = 'IES';
$lang['semic_apres_area'] = 'Apresentação por Áreas';

?>
