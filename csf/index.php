<?php
require("cab_csf.php");

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
array_push($menu,array('Ciência sem Fronteiras','Inscritos','csf_inscritos.php'));

array_push($menu,array('Ciência sem Fronteiras','Estudantes do CSF','csf_estudantes.php'));
array_push($menu,array('Ciência sem Fronteiras','Exportar dados para o site','csf_estudantes_site.php'));

array_push($menu,array('Site do CSF','Site oficial da Ciência sem fronteiras','http://www.cienciasemfronteiras.gov.br" target="new'));
array_push($menu,array('Site do CSF','Site da PUCPR do CSF','http://www2.pucpr.br/reol/cienciasemfronteiras" target="new')); 

///////////////////////////////////////////////////// redirecionamento
if ((isset($dd[1])) and (strlen($dd[1]) > 0))
	{
	$col=0;
	for ($k=0;$k <= count($menu);$k++)
		{
		 if ($dd[1]==CharE($menu[$k][1])) {	header("Location: ".$menu[$k][2]); } 
		}
	}
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