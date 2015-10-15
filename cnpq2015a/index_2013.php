<?
$breadcrumbs=array();
require("cab_cnpq.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

/////////////////////////////////////////////////// MANAGERS

echo '<h1>Incia��o Cient�fica (IC) da PUCPR</h1>';
$menu = array();
array_push($menu,array('Inicia��o Cient�fica','Panorama da Pesquisa na PUCPR','cnpq_panorama_2013.php'));
array_push($menu,array('Inicia��o Cient�fica','Experi�ncia Institucional na IC','cnpq_experiencia_institucional_ic_2013.php'));
array_push($menu,array('Inicia��o Cient�fica','Experi�ncia Institucional na IC J�nior','cnpq_experiencia_institucional_ic_jr_2013.php'));
array_push($menu,array('Inicia��o Cient�fica','Relato do processo de sele��o','cnpq_relato_do_processo_de_selecao_2013.php'));
array_push($menu,array('Inicia��o Cient�fica','Membros do Comit� Gestor','cnpq_membros_do_comite_gestor_2013.php'));
array_push($menu,array('Inicia��o Cient�fica','Edital IC 001/'.date("Y"),'edital_ic_2013.pdf'));

array_push($menu,array('Edital de Inicia��o Ci�nt�fica e Tecnol�gica','Demanda Edital '.date("Y"),'ic_demanda.php?dd0=2013')));

array_push($menu,array('Programas','<font color="BLUE"><B>PIBIC</B></font>','index_ic.php?dd0=PIBIC'));
array_push($menu,array('Programas','<font color="BROWN"><B>PIBITI</B></font>','index_ic.php?dd0=PIBITI'));
array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC_EM (Jr)</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC Jr</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="GREEN"><B>Ci�ncia sem Fronteiras</B></font>','index_ic.php?dd0=CSF'));
echo menus($menu,"3");

require("../foot.php");	
?>