<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));

require("cab.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Iniciação Científica','IC','')); 
array_push($menu,array('Iniciação Científica','__Inicição Científica x Cursos Discentes','ic_cursos.php'));
array_push($menu,array('Iniciação Científica','__Docentes Strict Sensu','iniciacao_cientifica_docentes.php?dd1=S'));

?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>