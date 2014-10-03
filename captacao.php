<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Agências de fomento','Agências de Fomento','agencia_de_fomento.php'));
array_push($menu,array('Agências de fomento','Editais de Fomento','agencia_editais.php'));
array_push($menu,array('Agências de fomento','Demandas de editais','agencia_editais_demandas.php'));
array_push($menu,array('Agências de fomento','Convenios de Fomento','agencia_de_fomento.php'));

array_push($menu,array('Captação de projetos','Captações','captacao_lista.php')); 
array_push($menu,array('Captação de projetos','Enviar e-mail de Atualização','captacao_lista_email.php'));
array_push($menu,array('Captação de projetos','Últimas Atualizações','captacao_lista_update.php')); 
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>