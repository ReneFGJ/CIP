<?php
require("cab_cip.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require("../_class/_class_docentes.php");
$docente = new docentes;

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;
$rlt = $bon->bonificacao_prof_projetos($dd[0]);
if (strlen($dd[0]) > 0) { echo $bon->isencao_proj_mostra_F($rlt); }

require("../foot.php");
?>
