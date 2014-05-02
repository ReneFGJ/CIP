<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));

require("cab.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Layout','Apoiadores / Sponsor','layout_apoio.php'));
array_push($menu,array('Layout','Bases Indexadores','layout_apoio.php'));

array_push($menu,array('Layout','Cadastro Sponsor / Indexadores','patrocinadores.php'));

?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>