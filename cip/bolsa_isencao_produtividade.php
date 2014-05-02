<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require("../_class/_class_docentes.php");
$docente = new docentes;

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

$rlt = $bon->bonificacao_prof_produtividade();
echo $bon->bonificacao_prof_mostra($rlt);

require("../foot.php");
?>
