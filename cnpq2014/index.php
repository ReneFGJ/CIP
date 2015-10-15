<?
$breadcrumbs=array();
require("cab_cnpq.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

/////////////////////////////////////////////////// MANAGERS

echo '<h1>Semin�rio de Inicia��o Cient�fica e P�s-Gradua��o / XXII Semin�rio de Inicia��o Cient�fica</h1>';
$menu = array();
array_push($menu,array('Sobre o Semin�rio de IC/3� CICPG','Panorama do evento','semic_about.php'));
array_push($menu,array('Programas','<font color="BLUE"><B>PIBIC</B></font>','semic_ic.php?dd0=PIBIC'));
array_push($menu,array('Programas','<font color="BROWN"><B>PIBITI</B></font>','semic_ic.php?dd0=PIBITI'));
array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC_EM (Jr)</B></font>','semic_ic.php?dd0=PIBICE'));

//array_push($menu,array('Edital de Inicia��o Ci�nt�fica e Tecnol�gica','Demanda Edital '.date("Y"),'ic_demanda.php?dd0=2014'));

echo menus($menu,"3");

echo '<h1>Incia��o Cient�fica (IC) da PUCPR</h1>';
$menu = array();
array_push($menu,array('Inicia��o Cient�fica','Panorama da Pesquisa na PUCPR','cnpq_panorama_2014.php'));
array_push($menu,array('Inicia��o Cient�fica','Experi�ncia Institucional na IC','cnpq_experiencia_institucional_ic_2014.php'));
array_push($menu,array('Inicia��o Cient�fica','Experi�ncia Institucional na IC J�nior','cnpq_experiencia_institucional_ic_jr_2014.php'));
array_push($menu,array('Inicia��o Cient�fica','Relato do processo de sele��o','cnpq_relato_do_processo_de_selecao_2014.php'));
array_push($menu,array('Inicia��o Cient�fica','Membros do Comit� Gestor','cnpq_membros_do_comite_gestor_2014.php'));
array_push($menu,array('Inicia��o Cient�fica','Semin�rio de Inicia��o Cient�fica (SEMIC)','cnpq_semic_2014.php'));
array_push($menu,array('Inicia��o Cient�fica','Novos programas IC','cnpq_mobilidade_2014.php'));
array_push($menu,array('Inicia��o Cient�fica','Edital IC 003/2014','arq/2014/cadernos_de_normas_2014.pdf'));

//array_push($menu,array('Edital de Inicia��o Ci�nt�fica e Tecnol�gica','Demanda Edital '.date("Y"),'ic_demanda.php?dd0=2014'));

array_push($menu,array('Programas','<font color="BLUE"><B>PIBIC</B></font>','index_ic.php?dd0=PIBIC'));
array_push($menu,array('Programas','<font color="BROWN"><B>PIBITI</B></font>','index_ic.php?dd0=PIBITI'));
array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC_EM (Jr)</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC Jr</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="GREEN"><B>Ci�ncia sem Fronteiras</B></font>','index_ic.php?dd0=CSF'));
echo menus($menu,"3");

require("../foot.php");	
?>