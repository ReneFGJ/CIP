<?php
require ("cab_semic.php");

require ("model/semic_notas.php");
$nt = new semic_nota;

echo '<h1>Apresentação por áreas</h1>';
echo $nt -> apresentacao_tipo($dd[0]);
?>
