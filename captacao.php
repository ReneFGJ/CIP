<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Capta��o'));

require("cab.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Ag�ncias de fomento','Ag�ncias de Fomento','agencia_de_fomento.php'));
array_push($menu,array('Ag�ncias de fomento','Editais de Fomento','agencia_editais.php'));
array_push($menu,array('Ag�ncias de fomento','Demandas de editais','agencia_editais_demandas.php'));
array_push($menu,array('Ag�ncias de fomento','Convenios de Fomento','agencia_de_fomento.php'));

array_push($menu,array('Capta��o de projetos','Capta��es','captacao_lista.php')); 
array_push($menu,array('Capta��o de projetos','Enviar e-mail de Atualiza��o','captacao_lista_email.php'));
array_push($menu,array('Capta��o de projetos','�ltimas Atualiza��es','captacao_lista_update.php')); 
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>