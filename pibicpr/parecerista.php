<?php
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Avaliadores</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';

//$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";

//////////////////// MANAGERS ///////////////////////////////
$menu = array();

	array_push($menu,array('Avaliadores','Avaliadores PUCPR','professores_ic.php'));
	array_push($menu,array('Avaliadores','Avaliadores Externos','avaliadores_ic.php'));
	array_push($menu,array('Avaliadores','Banco de Avaliadores PUCPR','banco_professores_ic.php'));
	array_push($menu,array('Avaliadores','Qtd. projetos submetidos �rea','qtd_projetos_area.php')); 
	array_push($menu,array('Avaliadores','Cadastros de �rea ao curso','banco_professores_escolher_areas.php')); 	

	array_push($menu,array('Avaliadores','Avaliadores','')); 
	array_push($menu,array('Avaliadores','__Resumo','paraceristas_rel_resumo.php'));
	array_push($menu,array('Avaliadores','__Cadastro','pareceristas_cadastro.php'));
	
	 
	array_push($menu,array('Avaliadores','E-mail',''));
	array_push($menu,array('Avaliadores','__Enviar convite','pareceristas_enviar_convite.php'));
	//array_push($menu,array('Avaliadores','__Enviar convite','pareceristas_lista_convite.php'));
		  
	array_push($menu,array('Relat�rio','Professores Doutores/IC','professores_ic.php'));
	array_push($menu,array('Relat�rio','Relat�rio anal�tico Avaliadores Dispon�veis','pareceristas_analitico.php?dd0='.date("Y")));
	array_push($menu,array('Relat�rio','Pareceres n�o entregues do Comit� de �tica (CEP)','rel_etica_entregas.php')); 
	//array_push($menu,array('Relat�rio','__Pareceristas / Institui��o','paraceristas_rel_parecerista_instituicao.php')); 
	//array_push($menu,array('Relat�rio','__Pareceristas / Produtividade','paraceristas_rel_parecerista_produtividade.php'));	

	//array_push($menu,array('Pareceristas (Convites)','Pareceristas','')); 
	//array_push($menu,array('Pareceristas (Convites)','__Incluir dados do convite','pareceristas_limbo_insert.php'));
	//array_push($menu,array('Pareceristas (Convites)','__Lista dos convidados','pareceristas_limbo_listar.php'));
	//array_push($menu,array('Pareceristas (Convites)','__Cadastro','pareceristas_limbo.php'));
	//array_push($menu,array('Pareceristas (Convites)','__Enviar convite (status 9)','parecerista_enviar_convite.php'));

	//array_push($menu,array('Pareceristas','Pareceristas (Comit� Local)','parecerista_rel_comite.php?dd0=1')); 
	//array_push($menu,array('Pareceristas','Pareceristas (Comit� Gestor)','parecerista_rel_comite.php?dd0=2'));
	//array_push($menu,array('Pareceristas','Pareceristas externos','parecerista_rel_externo.php'));	
  
	//array_push($menu,array('�rea do conhecimento','�rea do conhecimento (relat�rio)','rel_ajax_areadoconhecimento.php')); 
	//array_push($menu,array('�rea do conhecimento','�rea do conhecimento (desbilitar semic)','ajax_areadoconhecimento_sel.php')); 
	
	//array_push($menu,array('�rea do conhecimento','Parecerista sem �rea','rel_parecerista_sem_area.php'));


///////////////////////////////////////////////////// redirecionamento

?>
<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="bolsa.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?php
menus($menu,'3');
?>
</TABLE>
<?php
require("../foot.php");	
?>