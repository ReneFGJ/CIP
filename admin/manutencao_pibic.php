<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';


$file = '../messages/msg_index.php';
if (file_exists($file)) { require($file); }

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Bolsas Implementadas','Manuten��o de bolsas','pibic_bolsas.php'));
 
array_push($menu,array('Pagamentos','Inportar pagamentos de pagamentos','pibic_02.php'));
array_push($menu,array('Pagamentos','Editar lan�amentos','pibic_03.php'));

array_push($menu,array('Avaliadores','Mudar todos para enviar convite','avaliadores_enviar_convite.php'));

array_push($menu,array('Avalia��es','Cancelar todas as indica��es','pibic_04.php')); 

array_push($menu,array('Avalia��es','Manuten��o das indica��es','pibic_05.php'));

array_push($menu,array('Contrato','Emissao de contratos','pibic_contrato.php')); 


array_push($menu,array('Calend�rio','Calend�rio de eventos','admin_calender.php'));
array_push($menu,array('Calend�rio','Tipos de eventos','admin_calender_type.php'));

?>

<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="index.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?php
	$tela = menus($menu,"3");

require("../foot.php");	
?>