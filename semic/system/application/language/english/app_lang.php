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
$lang['busca'] = 'SEARCH';

/* Top MENU */
$lang['top_menu_01'] = 'SEMIC';
$lang['top_menu_02'] = 'Programme';
$lang['top_menu_03'] = 'Conference Committee';
$lang['top_menu_04'] = 'Index';
$lang['top_menu_05'] = 'Back Editions';

$lang['top_menu_08'] = 'Certificates Issuance';

/* Box O que � o semic */
$lang['whats_semic'] = 'Whats this SEMIC?';
$lang['whats_semic_text'] = 'The Scientific Seminar (SEMIC) is an open community event taking its scientific programming lectures, panel discussions, mini-courses in addition to the presentations of the results of research carried out throughout the year. Since 2014, the event also features a cultural program, linking science, art and culture ...';
$lang['read_more'] = '+ read more';
$lang['bt_prog_cultural'] = 'Cultural Program';
$lang['modalidade_edital'] = 'Modality of IC';
$lang['about_system'] = 'About the event';
$lang['contact_system'] = 'Contact the organization';
$lang['presentation'] = 'PRESENTATION';
$lang['cwb'] = 'Science without Borders';
$lang['program'] = 'Programmation';
$lang['access'] = 'Access here';
$lang['back'] = 'Back to the top';

//footer
$lang['colaboracao'] = 'Fostering agencies';
$lang['apoio'] = 'Support';
$lang['ies'] = 'IES';
$lang['semic_apres_area'] = 'Presentation by Areas';


?>
