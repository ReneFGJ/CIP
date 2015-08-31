<?php
require ("cab_semic.php");

require ("model/semic_notas.php");
$nt = new semic_nota;

echo '<h1>Trabalhos não indicados para apresentação Oral/Pôster</h1>';
echo $nt -> nao_indicados_apresentacao();
?>
