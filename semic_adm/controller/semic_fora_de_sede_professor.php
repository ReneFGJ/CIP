<?php
require ("cab_semic.php");

require ("model/semic_notas.php");
$nt = new semic_nota;

echo '<h1>Professores - Fora de sede</h1>';
echo $nt -> resumo_fora_de_sede('P');
?>
