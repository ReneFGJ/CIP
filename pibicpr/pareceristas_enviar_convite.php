<?php
require("cab.php");
require($include.'sisdoc_email.php');
require('../_class/_class_pareceristas.php');
$par = new parecerista;

require('../_class/_class_ic.php');
$ic = new ic;

$txt = $ic->ic('PAR_CONVITE_EXT');

$titulo = $txt['nw_titulo'];
$texto = $txt['nw_descricao'];

echo '<table width="700">';
echo '<TR><TD>'.$titulo;
echo '<TR><TD>'.mst($texto);

$total = $par->enviar_convite_total();
$par->enviar_convite(9,$titulo,$texto);

require("../foot.php");
?>
