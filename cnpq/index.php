<?
$breadcrumbs=array();
require("cab_cnpq.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

/////////////////////////////////////////////////// MANAGERS

echo '<h1>Inciação Científica (IC) da PUCPR</h1>';
$menu = array();
//array_push($menu,array('Iniciação Científica','Panorama da Pesquisa na PUCPR','cnpq_panorama_2015.php'));
array_push($menu,array('Iniciação Científica','Experiência Institucional na IC','cnpq_experiencia_institucional_ic_2015.php'));
array_push($menu,array('Iniciação Científica','Experiência Institucional na IC Júnior','cnpq_experiencia_institucional_ic_jr_2015.php'));
array_push($menu,array('Iniciação Científica','Relato do processo de seleção','cnpq_relato_do_processo_de_selecao_2015.php'));
array_push($menu,array('Iniciação Científica','Membros do Comitê Gestor','cnpq_membros_do_comite_gestor_2015.php'));
array_push($menu,array('Iniciação Científica','Seminário de Iniciação Científica (SEMIC)','cnpq_semic_2015.php'));
array_push($menu,array('Iniciação Científica','Novos programas IC','cnpq_mobilidade_2015.php'));
array_push($menu,array('Iniciação Científica','Edital IC 003/2015','arq/2015/cadernos_de_normas_2015.pdf'));

//Validacao de perfil de test
if ($perfil->valid('#TST'))
	{
	  array_push($menu,array('Teste grafico','pizza','view/apresentacao_origem_bolsas.php'));
	  array_push($menu,array('Teste grafico','barras','view/apresentacao_semic.php'));
	}

//array_push($menu,array('Edital de Iniciação Ciêntífica e Tecnológica','Demanda Edital '.date("Y"),'ic_demanda.php?dd0=2015'));

array_push($menu,array('Programas','<font color="BLUE"><B>PIBIC</B></font>','index_ic.php?dd0=PIBIC'));
array_push($menu,array('Programas','<font color="BROWN"><B>PIBITI</B></font>','index_ic.php?dd0=PIBITI'));
array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC_EM (Jr)</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC Jr</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="GREEN"><B>Ciência sem Fronteiras</B></font>','index_ic.php?dd0=CSF'));
echo menus($menu,"3");

require("../foot.php");	
?>