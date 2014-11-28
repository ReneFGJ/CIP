<?php
require("cab.php");
require("../_class/_class_protocolo.php");
require($include.'_class_form.php');

$proto = new protocolo;

echo '<h1>'.$proto->mostra_tipo_pai($dd[1]).'</h1>';
echo '<h3>'.$proto->mostra_tipo($dd[1]).'</h3>';

echo $proto->editar_protocolo('',$dd[1]);

require('../foot.php');

?>