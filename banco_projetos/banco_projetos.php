<?php
require("cab_bp.php");
echo '<H1>Banco de Projetos</h2>';

require("../_class/_class_banco_projetos.php");
$bp = new projetos;

echo $bp->lista_projetos();

require("../foot.php");
?>
