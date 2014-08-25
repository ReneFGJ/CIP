<?php
/*** Modelo ****/
require("cab_pos.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');


/*
 *  programa_pos_linhas
 */
	/* Dados da Classe */
	require('../_class/_class_programa_pos_linhas.php');

	$clx = new pos_linha;
	$cp = $clx->cp();
	
		
	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
	/* Não alterar - dados comuns */
	$label = msg($tabela);
	$http_edit = $tabela.'_ed.php'; 
	$http_ver = $tabela.'_detalhe.php'; 
	$editar = True;
	$http_redirect = $tabela.'.php';
	$clx->row();
	$busca = true;
	$offset = 20;
	
	
	
	if ($perfil->valid('#SEP'))
		{
			$tabela = '(select * from '.$clx->tabela.' 
					inner join programa_pos on posln_programa = pos_codigo
					) as tabela
					';
		} else {
			$wh = '1=1';
			$perfil = $ss->user_perfil;
			
			echo '-->'.$perfil;
			$tabela = '(select * from '.$clx->tabela.' 
					inner join programa_pos on posln_programa = pos_codigo
					where '.$wh.' 
					) as tabela
					';
		}
	echo $perfil;
	
	if ($order == 0) { $order  = $cdf[1]; }
	
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 