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
	//array_push($menu,array('SEMIC-PRE','Exportar trabalhos para o SEMIC (MOSTRA)','semic_export.php'));
	//array_push($menu,array('SEMIC-PRE','Exportar trabalhos para o SEMIC (IC)','semic_export_semic.php'));		
		
	array_push($menu,array('SEMIC','SEMIC Divisão de areas','semic_secoes.php'));
	array_push($menu,array('SEMIC','SEMIC Exportar dados para o Word','semic_trabalhos_word.php'));
	array_push($menu,array('SEMIC','SEMIC Exportar dados para o Word (PÓS)','semic_trabalhos_word.php?dd1=pos'));
	
	array_push($menu,array('SEMIC','SEMIC Exportar SITE','semic_trabalhos_semic.php'));
		
	array_push($menu,array('SEMIC','Gerar índice de assuntos','semic_trabalhos_index.php'));
	array_push($menu,array('SEMIC','Gerar página de índice de assuntos','semic_trabalhos_index_2.php'));
	
	array_push($menu,array('SEMIC Validação','Validação com o professor','semic_validacao_trabalhos.php'));
	array_push($menu,array('SEMIC Validação','Validações efetivadas','semic_validacao.php'));
	
	array_push($menu,array('SEMIC Validação','Modalidade x Publicação no SEMIC','semic_bolsa_publicacao.php'));
	
	array_push($menu,array('SEMIC Avaliacao','Avaliadores-Cracha','semic_avaliadores-cracha.php'));

	array_push($menu,array('SEMIC Paineis','Importar posição dos paineis','semic_paineis_importar.php'));
	array_push($menu,array('SEMIC Paineis','Listar Paineis','semic_paineis_listar.php'));
	array_push($menu,array('SEMIC Paineis','Etiquetas','semic_paineis_etiquetas.php'));
	array_push($menu,array('SEMIC Paineis','Exportar localização','semic_paineis_localizacao_exportar.php'));
	}
$tela = menus($menu,"3");
	

require("../foot.php");	
?>