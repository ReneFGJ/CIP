<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relat�rios'));

require("cab.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Inicia��o Cient�fica','IC','')); 
array_push($menu,array('Inicia��o Cient�fica','__Inici��o Cient�fica x Cursos Discentes','ic_cursos.php'));
array_push($menu,array('Inicia��o Cient�fica','__Docentes Strict Sensu','iniciacao_cientifica_docentes.php?dd1=S'));

?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>