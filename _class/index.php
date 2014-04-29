<?php
require "cab_fomento.php";

require "../_class/_class_fomento.php";
$fomento = new fomento;

echo $fomento->resumo();

echo "
<h1> Tags </h1>
<p> <a href=\"$url_nova_tag\">Clique aqui para criar uma nova tag</a> </p>
<p> <a href=\"$url_listar_tags\">Listar e manejar tags</a> </p>

";
require("../foot.php");
?>