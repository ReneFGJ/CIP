<?
$breadcrumbs=array();
require("cab_cnpq.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

/////////////////////////////////////////////////// MANAGERS

echo '<h1>Seminário de Iniciação Científica e Pós-Graduação / XXII Seminário de Iniciação Científica</h1>';
$menu = array();
array_push($menu,array('Sobre o Seminário de IC/3º CICPG','Panorama do evento','semic_about.php'));
array_push($menu,array('Programas','<font color="BLUE"><B>PIBIC</B></font>','semic_ic.php?dd0=PIBIC'));
array_push($menu,array('Programas','<font color="BROWN"><B>PIBITI</B></font>','semic_ic.php?dd0=PIBITI'));
array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC_EM (Jr)</B></font>','semic_ic.php?dd0=PIBICE'));

//array_push($menu,array('Edital de Iniciação Ciêntífica e Tecnológica','Demanda Edital '.date("Y"),'ic_demanda.php?dd0=2014'));

echo menus($menu,"3");

echo '<h1>Inciação Científica (IC) da PUCPR</h1>';
$menu = array();
array_push($menu,array('Iniciação Científica','Panorama da Pesquisa na PUCPR','cnpq_panorama_2014.php'));
array_push($menu,array('Iniciação Científica','Experiência Institucional na IC','cnpq_experiencia_institucional_ic_2014.php'));
array_push($menu,array('Iniciação Científica','Experiência Institucional na IC Júnior','cnpq_experiencia_institucional_ic_jr_2014.php'));
array_push($menu,array('Iniciação Científica','Relato do processo de seleção','cnpq_relato_do_processo_de_selecao_2014.php'));
array_push($menu,array('Iniciação Científica','Membros do Comitê Gestor','cnpq_membros_do_comite_gestor_2014.php'));
array_push($menu,array('Iniciação Científica','Seminário de Iniciação Científica (SEMIC)','cnpq_semic_2014.php'));
array_push($menu,array('Iniciação Científica','Novos programas IC','cnpq_mobilidade_2014.php'));
array_push($menu,array('Iniciação Científica','Edital IC 003/2014','arq/2014/cadernos_de_normas_2014.pdf'));

//array_push($menu,array('Edital de Iniciação Ciêntífica e Tecnológica','Demanda Edital '.date("Y"),'ic_demanda.php?dd0=2014'));

array_push($menu,array('Programas','<font color="BLUE"><B>PIBIC</B></font>','index_ic.php?dd0=PIBIC'));
array_push($menu,array('Programas','<font color="BROWN"><B>PIBITI</B></font>','index_ic.php?dd0=PIBITI'));
array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC_EM (Jr)</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="ORANGE"><B>PIBIC Jr</B></font>','index_ic.php?dd0=PIBICE'));
//array_push($menu,array('Programas','<font color="GREEN"><B>Ciência sem Fronteiras</B></font>','index_ic.php?dd0=CSF'));
echo menus($menu,"3");

require("../foot.php");	
?>