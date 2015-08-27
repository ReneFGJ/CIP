<?php
require ("cab_semic.php");

require ("model/semic_notas.php");
$nt = new semic_nota;

echo '<h1>Estudantes - Fora de sede</h1>';
echo $nt -> resumo_fora_de_sede('A');
?>
