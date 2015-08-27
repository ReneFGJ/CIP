<?php
require ("cab_semic.php");

require ("model/semic_notas.php");
$nt = new semic_nota;

echo '<h1>Apresentação Oral/Postêr (Português)</h1>';
echo $nt -> edital_quartil('1');
echo '<BR><BR>';
echo '<h1>Apresentação Oral/Postêr (Inglês)</h1>';
echo $nt -> edital_quartil('2');
?>
