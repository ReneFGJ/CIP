<?php
require ("cab_semic.php");

require ("model/semic_notas.php");
$nt = new semic_nota;

echo $nt->resumo_apresentacao();

if ($dd[0] == 99) { $nt -> dropall();
}

if ($dd[0] == 1) { echo '<h1>FASE I</h1>';
	echo $nt -> phase_i();
}

if ($dd[0] == 2) { echo '<h1>FASE II</h1>';
	echo $nt -> phase_ii();
}

if ($dd[0] == 3) { echo '<h1>FASE III</h1>';
	echo $nt -> phase_iii();
}

if ($dd[0] == 4) { echo '<h1>FASE IV</h1>';
	echo $nt -> phase_iv();
}

if ($dd[0] == 5) { echo '<h1>FASE V</h1>';
	echo $nt -> phase_v();
}

if ($dd[0] == 6) { echo '<h1>FASE VI</h1>';
	echo $nt -> phase_vi();
}

if ($dd[0] == 7) { echo '<h1>FASE VII</h1>';
	echo $nt -> phase_vii();
}

if ($dd[0] == 8) { echo '<h1>FASE VIII</h1>';
	echo $nt -> phase_viii();
}

echo '<h1>TODOS</h1>';
echo $nt -> resumo();
?>
