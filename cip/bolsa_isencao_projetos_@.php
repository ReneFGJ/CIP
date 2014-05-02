<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');

require($include.'sisdoc_form2.php');
require($include.'sisdoc_email.php');
require($include.'cp2_gravar.php');

require("_email.php");
require("../_class/_class_docentes.php");
$docente = new docentes;


/* Identificar vinculo */
$cp = array();
array_push($cp,array('$H8','','',True,Ture));
array_push($cp,array('$H8','','',True,Ture));
array_push($cp,array('$O S:SIM','','Confirmar envio do e-mail',True,Ture));
echo '<table><TR><TD>';
editar();
echo '</table>';
if (strlen($dd[1]) > 0)
	{
	require("../_class/_class_bonificacao.php");
	$bon = new bonificacao;
	$bon->isencao_produtividade_comunicar_pesquisador($dd[0],$dd[1]);
	echo $bon->erro;
	}

require("../foot.php");
?>
