<?
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "";
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('Bolsas','Resumo das bolsas','pibic_bolsa_resumo.php')); 
	array_push($menu,array('Pareceristas','Pareceristas','ed_pareceristas.php')); 

	
///////////////////////////////////////////////////// redirecionamento

?>
<TABLE width="<?=$tab_max;?>" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="main_menu.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?
menus($menu,'3');
?>
</TABLE>
