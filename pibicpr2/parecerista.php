<?php
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('Pareceristas','Pareceristas','')); 
	array_push($menu,array('Pareceristas','__Resumo','paraceristas_rel_resumo.php')); 
	array_push($menu,array('Pareceristas','__Cadastro','ed_pareceristas.php'));
	  
	array_push($menu,array('Relatório','Pareceristas','')); 
	array_push($menu,array('Relatório','__Pareceristas / Instituição','paraceristas_rel_parecerista_instituicao.php')); 
	array_push($menu,array('Relatório','__Pareceristas / Produtividade','paraceristas_rel_parecerista_produtividade.php'));	

	array_push($menu,array('Pareceristas (Convites)','Pareceristas','')); 
	array_push($menu,array('Pareceristas (Convites)','__Incluir dados do convite','pareceristas_limbo_insert.php'));
	array_push($menu,array('Pareceristas (Convites)','__Lista dos convidados','pareceristas_limbo_listar.php'));
	array_push($menu,array('Pareceristas (Convites)','__Cadastro','pareceristas_limbo.php'));
	array_push($menu,array('Pareceristas (Convites)','__Enviar convite (status 9)','parecerista_enviar_convite.php'));

	array_push($menu,array('Pareceristas','Pareceristas (Comitê Local)','parecerista_rel_comite.php?dd0=1')); 
	array_push($menu,array('Pareceristas','Pareceristas (Comitê Gestor)','parecerista_rel_comite.php?dd0=2'));
	array_push($menu,array('Pareceristas','Pareceristas externos','parecerista_rel_externo.php'));	

	array_push($menu,array('Área do conhecimento','Área do conhecimento','http://www.pucpr.br/cip')); 
	array_push($menu,array('Área do conhecimento','Área do conhecimento (relatório)','rel_ajax_areadoconhecimento.php')); 
	array_push($menu,array('Área do conhecimento','Área do conhecimento (desbilitar semic)','ajax_areadoconhecimento_sel.php')); 
	
	array_push($menu,array('Área do conhecimento','Parecerista sem área','rel_parecerista_sem_area.php'));


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
require("foot.php");	
?>