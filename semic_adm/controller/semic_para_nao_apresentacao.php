<?php
require ("cab_semic.php");

require ("model/semic_notas.php");
$nt = new semic_nota;

echo '<h1>Trabalhos n�o indicados para apresenta��o Oral/P�ster</h1>';
echo $nt -> nao_indicados_apresentacao();
?>
