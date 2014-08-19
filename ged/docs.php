<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));

require("cab.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Documentos','Documentos','')); 
array_push($menu,array('Documentos','__documentos_disponiveis','docs_list.php'));
array_push($menu,array('Documentos','__enviar_novo_documento','docs_upload_new.php'));
array_push($menu,array('Documentos','__tipos_documentos','docs_type.php'));
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>