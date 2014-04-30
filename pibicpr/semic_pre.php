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
	array_push($menu,array('SEMIC','SEMIC Internacionalização','semic_internacionalizacao.php'));
	if (($perfil->valid('#PIT')) or ($perfil->valid('#ADM')))
		{		
		array_push($menu,array('SEMIC','Resumos para publicação (PIBIC/PIBITI)','semic_resumo_pre.php'));
		array_push($menu,array('SEMIC','Resumos para publicação (Pós-Graduação)','semic_resumo_pre_amostra.php'));
		array_push($menu,array('SEMIC','Projetos ativos sem publicação no SEMIC','semic_resumo_sem_semic.php'));
		
		array_push($menu,array('Seções','Editar Seções','secoes.php'));
		array_push($menu,array('Seções','Reordenar Seções','secoes_reordem.php'));
		array_push($menu,array('Seções','Limpar Seções','secoes_limpar.php'));
		array_push($menu,array('Tesauro','Tesauro','tesauro.php'));
		
		array_push($menu,array('Correções','Correções Automáticas','correcoes_automaticas.php'));
		array_push($menu,array('SEMIC Gestão','Publicações sem o Inglês','semic_resumo_sem_ingles.php'));
		
		array_push($menu,array('Programação','Importar programação','semic_programacao_importar.php'));
		array_push($menu,array('Programação','Programação / Trabalho','semic_programacao_1.php'));
		array_push($menu,array('Programação','Trabalho / Programação','semic_programacao_2.php'));	
		} 		
	}
	array_push($menu,array('SEMIC','Revisão do Inglês para o SEMIC','semic_resumo_eng.php'));

	$tela = menus($menu,"3");

require("../foot.php");	
?>