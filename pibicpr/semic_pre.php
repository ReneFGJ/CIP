<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';


$file = '../messages/msg_index.php';
if (file_exists($file)) { require($file); }

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
if (($perfil->valid('#PIT')) or ($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('SEMIC','SEMIC Internacionaliza��o','semic_internacionalizacao.php'));
	if (($perfil->valid('#PIT')) or ($perfil->valid('#ADM')))
		{		
		array_push($menu,array('SEMIC','Resumos para publica��o (PIBIC/PIBITI)','semic_resumo_pre.php'));
		array_push($menu,array('SEMIC','Resumos para publica��o (P�s-Gradua��o)','semic_resumo_pre_amostra.php'));
		array_push($menu,array('SEMIC','Projetos ativos sem publica��o no SEMIC','semic_resumo_sem_semic.php'));
		
		array_push($menu,array('Se��es','Editar Se��es','secoes.php'));
		array_push($menu,array('Se��es','Reordenar Se��es','secoes_reordem.php'));
		array_push($menu,array('Se��es','Limpar Se��es','secoes_limpar.php'));
		array_push($menu,array('Tesauro','Tesauro','tesauro.php'));
		
		array_push($menu,array('Corre��es','Corre��es Autom�ticas','correcoes_automaticas.php'));
		array_push($menu,array('SEMIC Gest�o','Publica��es sem o Ingl�s','semic_resumo_sem_ingles.php'));
		
		array_push($menu,array('Programa��o','Importar programa��o','semic_programacao_importar.php'));
		array_push($menu,array('Programa��o','Programa��o / Trabalho','semic_programacao_1.php'));
		array_push($menu,array('Programa��o','Trabalho / Programa��o','semic_programacao_2.php'));	
		} 		
	}
	array_push($menu,array('SEMIC','Revis�o do Ingl�s para o SEMIC','semic_resumo_eng.php'));

	$tela = menus($menu,"3");

require("../foot.php");	
?>