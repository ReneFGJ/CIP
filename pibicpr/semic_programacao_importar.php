<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');

require('../_class/_class_semic.php');
$sm = new semic;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$A8','','Importação da programação',False,False));
array_push($cp,array('$T80:6','','Texto da programacao',False,False));
array_push($cp,array('$C1','','Zerar dados anterior',False,False));

echo '<table><TR><TD>';
editar();
echo '</table>';

if ($saved > 0)
	{
		$sm->importar_programacao($dd[2],$dd[3]);
	}

require("../foot.php");	
?>