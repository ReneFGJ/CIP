<?php
require("cab.php");
require($include.'sisdoc_email.php');
require($include.'sisdoc_debug.php');
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
require_once("../_class/_class_ic_relatorio_parcial.php");
$par = new ic_relatorio_parcial;
if (strlen($dd[1]) > 0) { $confirma = 1; }
else { $confirma=0; }
echo '<h1>Avaliações Indicadas</h1>';
echo '<h3>Relatório Parcial</h3>';

echo '<A HREF="'.page().'?dd10=1" class="botao-geral">Confirma envio!</A>';
echo '&nbsp;';
echo '<A HREF="'.page().'?dd10=-1" class="botao-geral">Enviar teste!</A>';

echo $par->idicacao_avaliador_email($confirma);

require("../foot.php");	
?>