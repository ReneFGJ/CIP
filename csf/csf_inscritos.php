<?php
require("cab_csf.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_colunas.php');
require($include.'cp2_gravar.php');

require("../_class/_class_csf.php");
$csf = new csf;
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
if (strlen($dd[3])==0) { $dd[3] = '01/08/'.date("Y"); }
if (strlen($dd[4])==0) { $dd[4] = date("d/m/Y"); }
$cp = array();
array_push($cp,array('$C','','Todos os editais&nbsp;',False,True));
array_push($cp,array('$Q fm_nome:fm_codigo:select * from fomento where fm_ativo = 1','','Nome do Edital',False,True));
array_push($cp,array('${','','Período de Inscrições&nbsp;',False,True));
array_push($cp,array('$D8','','Data Inicial&nbsp;',True,True));
array_push($cp,array('$D8','','Data Final&nbsp;',True,True));
array_push($cp,array('$O 1:Normal&2:Somente os e-mail','','Formato de saída',True,True));

array_push($cp,array('$}','','',False,True));

echo '<center>';
echo '<table width="'.$tab_max.'" border=1 ><TR><TD>';
editar();
echo '</table>';

if ($saved > 0)
	{
		if ($dd[0]==1) { $dd[1] = ''; }
		require("../_class/_class_fomento.php");
		$fom = new fomento;
		echo '<h2>Relação de inscritos no Edital</h2>';
		echo $csf->lista_inscritos($dd[1],brtos($dd[3]),brtos($dd[4]),$dd[5]);
	}
require("../foot.php");
?>

