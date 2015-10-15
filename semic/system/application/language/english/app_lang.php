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
$lang['busca'] = 'SEARCH';


/* Top MENU */
$lang['top_menu_01'] = 'SEMIC';
$lang['top_menu_02'] = 'Programme';
$lang['top_menu_03'] = 'Conference Committee';
$lang['top_menu_04'] = 'Index';
$lang['top_menu_05'] = 'Back Editions';

?>
