<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');

require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

require("../_class/_class_docentes.php");
$docente = new docentes;


/* Identificar vinculo */
$cp = array();
array_push($cp,array('$H8','','',True,Ture));
array_push($cp,array('$Q ca_descricao:ca_protocolo:select * from captacao where ca_professor='.chr(39).$dd[0].chr(39).' order by ca_vigencia_ini_ano','','Vinculos ao projeto',True,Ture));
array_push($cp,array('$HV','','1',True,Ture));
echo '<table><TR><TD>';
editar();
echo '</table>';
if (strlen($dd[2]) > 0)
	{
	require("../_class/_class_bonificacao.php");
	$bon = new bonificacao;
	$bon->isencao_projeto_ativar($dd[0],$dd[1]);
	echo $bon->erro;
	
	echo '<form action="bolsa_isencao_projetos.php"><input type="submit" value="voltar"></form>';
	}

require("../foot.php");
?>
