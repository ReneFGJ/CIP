<?
$breadcrumbs=array();
require("cab_cnpq.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

/////////////////////////////////////////////////// MANAGERS

echo '<h1>Incia��o Cient�fica (IC) da PUCPR</h1>';
$menu = array();
//array_push($menu,array('Inicia��o Cient�fica','Panorama da Pesquisa na PUCPR','cnpq_panorama_2015.php'));
array_push($menu,array('Inicia��o Cient�fica','Experi�ncia Institucional na IC','cnpq_experiencia_institucional_ic_2015.php'));
array_push($menu,array('Inicia��o Cient�fica','Experi�ncia Institucional na IC J�nior','cnpq_experiencia_institucional_ic_jr_2015.php'));
array_push($menu,array('Inicia��o Cient�fica','Relato do processo de sele��o','cnpq_relato_do_processo_de_selecao_2015.php'));
array_push($menu,array('Inicia��o Cient�fica','Membros do Comit� Gestor','cnpq_membros_do_comite_gestor_2015.php'));
array_push($menu,array('Inicia��o Cient�fica','Semin�rio de Inicia��o Cient�fica (SEMIC)','cnpq_semic_2015.php'));
array_push($menu,array('Inicia��o Cient�fica','Novos programas IC','cnpq_mobilidade_2015.php'));
array_push($menu,array('Inicia��o Cient�fica','Edital IC 003/2015','arq/2015/cadernos_de_normas_2015.pdf'));

//Validacao de perfil de test
if ($perfil->valid('#TST'))
	{
	  array_push($menu,array('Teste grafico','pizza','view/apresentacao_origem_bolsas.php'));
	  array_push($menu,array('Teste grafico','barras','view/apresentacao_semic.php'));
	}

//array_push($menu,array('Edital de Inicia��o Ci�nt�fica e Tecnol�gica','Demanda Edital '.date("Y"),'ic_demanda.php?dd0=2015'));

array_push($menu,array('Programas','<font color="BLUE"><B>PIBIC</B></font>','index_ic.php?dd0=PIBIC'));
array_push($menu,array('Programas','<font color="BROWN"><B>PIBITI</B></font>','index_ic.php?dd0=PIBITI'));
array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC_EM (Jr)</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC Jr</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="GREEN"><B>Ci�ncia sem Fronteiras</B></font>','index_ic.php?dd0=CSF'));
echo menus($menu,"3");

require("../foot.php");	
?>