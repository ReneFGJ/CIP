<?php
require "cab_fomento.php";
renderiza_cabecalho_autentica();

require "../_class/_class_fomento.php";
$essaPagina = pathinfo_filename(__FILE__).'.php';
$fom_view = new fomento_view($essaPagina, $nw);

$html_form_busca=$fom_view->html_busca_livre_form();
$html_resultados_busca=$fom_view->html_busca_livre_resultados($dd[0], $dd[1], $dd[2]);

echo "
<h1> Buscar Editais </h1>
$html_form_busca
$html_resultados_busca
";

/*
<div style='text-align:center;'>
	$html_form_busca
</div>
 */

require("../foot.php");
?>